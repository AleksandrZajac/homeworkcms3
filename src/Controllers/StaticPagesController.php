<?php

namespace App\Controllers;

use App\Models\StaticPage;
use App\Requests\StaticPageRequest;
use App\View;

class StaticPagesController extends ModeratorController
{
    public function index()
    {
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = StaticPage::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = StaticPage::pagination($itemsOnPage);
        }

        $staticPages = $pagination['static-pages'];
        $pages = $pagination['pages'];

        return new View('page.index', compact('staticPages', 'pages', 'itemsOnPage'));
    }

    public function create()
    {
        return new View('page.create');
    }

    public function store()
    {
        $validator = new StaticPageRequest();
        $shortDescription = preg_match("/^(.{50,}?)\s+/s", $validator->request('description'), $m) ? $m[1] . '...' : $validator->request('description');
        $errors = $validator->errors();
        $old = $_POST;

        if (!$errors) {
            StaticPage::create([
                'slug' => str_replace([' ', '-'], '_', $validator->request('slug')),
                'title' => $validator->request('title'),
                'description' => $validator->request('description'),
                'short_description' => $shortDescription,
                'is_published' => $validator->request('is_published'),
            ]);

            $_SESSION['success'] = 'Страница успешно создана';

            $this->redirect('/');
        }

        return new View('page.create', compact('errors', 'old'));
    }

    public function show($slug)
    {
        $page = StaticPage::where('slug', $slug)->first();
        $allPages = StaticPage::all();

        return new View('page.show', compact('page', 'allPages'));
    }

    public function edit($slug)
    {
        $oldValues = StaticPage::where('slug', $slug)->first();

        return new View('page.edit', compact('oldValues'));
    }

    public function update($slug)
    {
        $page = StaticPage::where('slug', $slug)->first();
        $oldValues = $_POST;
        $validator = new StaticPageRequest($slug);
        $shortDescription = preg_match("/^(.{50,}?)\s+/s", $validator->request('description'), $m) ? $m[1] . '...' : $validator->request('description');
        $errors = $validator->errors();

        if (!$errors) {
            $page->update([
                'slug' => str_replace([' ', '-'], '_', $validator->request('slug')),
                'title' => $validator->request('title'),
                'description' => $validator->request('description'),
                'short_description' => $shortDescription,
                'is_published' => $validator->request('is_published'),
            ]);

            $_SESSION['success'] = 'Страница успешно создана';

            $this->redirect('/');
        }

        return new View('page.edit', compact('oldValues', 'errors'));
    }

    public function destroy($slug)
    {
        StaticPage::where('slug', $slug)->delete();
        $_SESSION['pages'] = StaticPage::all();
        $_SESSION['success'] = 'Страница успешно удалена';

        $this->redirect('/');
    }
}
