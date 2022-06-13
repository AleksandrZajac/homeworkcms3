<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Exception\UserExceptions;
use App\Config;
use App\View;

class AdminCommentsController extends BaseController
{
    public function edit()
    {
        UserExceptions::isAdminAndModeratorNotFoundException();
        $title = 'Комментарии';
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = Comment::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = Comment::pagination($itemsOnPage);
        }

        $statuses = Config::getInstance()->getConfig('env')['status'];

        $comments = $pagination['comments'];
        $pages = $pagination['pages'];

        return new View('comment.edit', compact('title', 'comments', 'pages', 'itemsOnPage', 'statuses'));
    }

    public function update()
    {
        $comment = Comment::where('id', $_POST['commentId'])->first();

        $comment->update([
            'status' => $_POST['status']
        ]);
    }
}
