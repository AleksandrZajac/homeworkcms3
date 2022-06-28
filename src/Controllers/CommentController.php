<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Requests\CommentRequest;
use App\Models\Article;
use App\Models\User;
use App\View;
use App\Config;
use App\Services\Queries\GetArticleComments;

class CommentController extends BaseController
{
    public function addComment()
    {
        $validator = new CommentRequest();
        $roles = Config::getInstance()->getConfig('env')['user_role'];
        $statuses = Config::getInstance()->getConfig('env')['status'];

        if (!isset($_SESSION['user_id'])) {
            $errors[] = 'Не авторизованный пользователь не может оставить комментарий';
            $article = Article::getById($_SESSION['article_id']);
            $comments = GetArticleComments::getComments($article->id);

            return new View('articles.show', compact('article', 'comments', 'roles', 'statuses', 'errors'));
        }

        $errors = $validator->errors();
        $status = $statuses['moderation'];
        if ($this->isAdmin() || $this->isModerator()) {
            $status = $statuses['allowed'];
        }

        if (!$errors) {
            Comment::create([
                'article_id' => $_SESSION['article_id'],
                'user_id' => $_SESSION['user_id'],
                'description' => $validator->request('description'),
                'status' => $status,
            ]);
        }

        $article = Article::getById($_SESSION['article_id']);
        $comments = GetArticleComments::getComments($article->id);

        return new View('articles.show', compact('article', 'comments', 'roles', 'statuses', 'errors'));
    }
}
