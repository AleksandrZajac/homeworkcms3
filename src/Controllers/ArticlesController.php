<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Subscribe;
use App\View;
use App\Config;
use App\Services\Queries\GetArticleComments;
use App\Services\Settings;

class ArticlesController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['login']) && Subscribe::where('email', $_SESSION['login'])->first()) {
            $_SESSION['subscribe'] = 1;
        } else {
            $_SESSION['subscribe'] = 0;
        }

        $settings = Settings::getSettings();
        $pagination = Article::pagination($settings['items_on_articles_page'], 1);
        $articles = $pagination['articles'];
        $pages = $pagination['pages'];

        return new View('articles.index', compact('articles', 'pages'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $_SESSION['article_id'] = $article->id;
        $roles = Config::getInstance()->getConfig('env')['user_role'];
        $statuses = Config::getInstance()->getConfig('env')['status'];

        $comments = GetArticleComments::getComments($article->id);

        return new View('articles.show', compact('article', 'comments', 'roles', 'statuses'));
    }
}
