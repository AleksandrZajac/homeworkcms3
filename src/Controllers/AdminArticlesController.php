<?php

namespace App\Controllers;

use App\Models\Article;
use App\Exception\UserExceptions;
use App\Models\Subscribe;
use App\Requests\ArticleRequest;
use App\View;
use App\Services\FileUpload\File;
use App\Config;
use App\Services\Queries\GetArticleComments;
use App\Services\Email\SendEmail;
use App\Services\Settings;

class AdminArticlesController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['login']) && Subscribe::where('email', $_SESSION['login'])->first()) {
            $_SESSION['subscribe'] = 1;
        } else {
            $_SESSION['subscribe'] = 0;
        }

        $settings = Settings::getSettings();
        $pagination = Article::pagination($settings['items_on_articles_page']);
        $articles = $pagination['articles'];
        $pages = $pagination['pages'];
        $title = 'Articles';

        return new View('articles.index', compact('articles', 'title', 'pages'));
    }

    public function create()
    {
        UserExceptions::isAdminAndModeratorNotFoundException();
        $title = 'Создать статью';

        return new View('articles.create', compact('title'));
    }

    public function store()
    {
        $validator = new ArticleRequest();
        $errors = $validator->errors();
        $shortDescription = preg_match("/^(.{50,}?)\s+/s", $validator->request('description'), $m) ? $m[1] . '...' : $validator->request('description');

        $title = 'Создать статью';
        $old = $_POST;

        if (!$errors) {
            $image = new File('image');
            $image->uploadFile();

            Article::create([
                'owner_id' => $_SESSION['user_id'],
                'slug' => str_replace([' ', '-'], '_', $validator->request('slug')),
                'title' => $validator->request('title'),
                'image' => $image->addFileName(),
                'description' => $validator->request('description'),
                'short_description' => $shortDescription,
                'is_published' => $validator->request('is_published'),
            ]);

            SendEmail::sendNotification($validator->request('title'), $shortDescription, $validator->request('slug'));

            $_SESSION['success'] = 'Статья успешно создана';

            $this->redirect('/');
        }

        return new View('articles.create', compact('title', 'errors', 'old'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $title = $article->title;
        $_SESSION['article_id'] = $article->id;
        $roles = Config::getInstance()->getConfig('env')['user_role'];
        $statuses = Config::getInstance()->getConfig('env')['status'];

        $comments = GetArticleComments::getComments($article->id);

        return new View('articles.show', compact('article', 'comments', 'roles', 'statuses', 'title'));
    }

    public function edit($slug)
    {
        UserExceptions::isAdminAndModeratorNotFoundException();
        $old = Article::where('slug', $slug)->first();
        $title = $old->title;

        return new View('articles.edit', compact('old', 'title'));
    }

    public function update($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $validator = new ArticleRequest($slug);
        $shortDescription = preg_match("/^(.{50,}?)\s+/s", $validator->request('description'), $m) ? $m[1] . '...' : $validator->request('description');
        $errors = $validator->errors();
        $title = 'Создать статью';
        $old = $_POST;

        if (!$errors) {
            $image = new File('image');

            if ($image->error) {
                $article->update([
                    'slug' => str_replace([' ', '-'], '_', $validator->request('slug')),
                    'title' => $validator->request('title'),
                    'description' => $validator->request('description'),
                    'short_description' => $shortDescription,
                    'is_published' => $validator->request('is_published'),
                ]);
            } else {
                $image->uploadFile();

                $article->update([
                    'slug' => str_replace([' ', '-'], '_', $validator->request('slug')),
                    'title' => $validator->request('title'),
                    'image' => $image->addFileName(),
                    'description' => $validator->request('description'),
                    'short_description' => $shortDescription,
                    'is_published' => $validator->request('is_published'),
                ]);
            }

            $_SESSION['success'] = 'Статья успешно обновлена';

            $this->redirect('/');
        }

        return new View('articles.edit', compact('title', 'errors', 'old'));
    }

    public function destroy($slug)
    {
        $item = Article::where('slug', $slug)->first();

        $item->delete();

        $_SESSION['success'] = 'Статья успешно удалена';

        $this->redirect('/');
    }
}
