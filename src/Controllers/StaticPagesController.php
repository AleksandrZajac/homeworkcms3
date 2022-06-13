<?php

namespace App\Controllers;

use App\Models\StaticPage;
use App\Requests\StaticPageRequest;
use App\View;
use App\Exception\UserExceptions;

class StaticPagesController extends BaseController
{
    public function index()
    {
        UserExceptions::isAdminAndModeratorNotFoundException();

        $title = "Статические страницы";
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = StaticPage::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = StaticPage::pagination($itemsOnPage);
        }

        $staticPages = $pagination['static-pages'];
        $pages = $pagination['pages'];

        return new View('page.index', compact('staticPages', 'pages', 'title', 'itemsOnPage'));
    }

    public function create()
    {
        UserExceptions::isAdminAndModeratorNotFoundException();

        $title = 'Создать страницу';

        return new View('page.create', compact('title'));
    }

    public function store()
    {
        UserExceptions::isAdminAndModeratorNotFoundException();

        $validator = new StaticPageRequest();
        $shortDescription = preg_match("/^(.{50,}?)\s+/s", $validator->request('description'), $m) ? $m[1] . '...' : $validator->request('description');
        $errors = $validator->errors();

        $title = 'Создать страницу';
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

        return new View('page.create', compact('title', 'errors', 'old'));
    }

    public function show($slug)
    {
        $page = StaticPage::where('slug', $slug)->first();
        $title = $page->title;

        $allPages = StaticPage::all();

        return new View('page.show', compact('page', 'title', 'allPages'));
    }

    public function edit($slug)
    {
        UserExceptions::isAdminAndModeratorNotFoundException();

        $oldValues = StaticPage::where('slug', $slug)->first();
        $title = $oldValues->title;

        $title = 'Редактировать страницу ' . $oldValues->title;

        return new View('page.edit', compact('oldValues', 'title'));
    }

    public function update($slug)
    {
        UserExceptions::isAdminAndModeratorNotFoundException();

        $page = StaticPage::where('slug', $slug)->first();
        $title = 'Редактировать страницу ' . $page->title;
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

        return new View('page.edit', compact('oldValues', 'title', 'errors'));
    }

    public function destroy($slug)
    {
        // UserExceptions::isAdminAndModeratorNotFoundException();

        $item = StaticPage::where('slug', $slug)->first();

        $item->delete();

        $_SESSION['pages'] = StaticPage::all();

        $_SESSION['success'] = 'Страница успешно удалена';

        $this->redirect('/');
    }
}
