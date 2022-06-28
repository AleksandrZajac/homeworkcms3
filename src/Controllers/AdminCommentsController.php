<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Config;
use App\View;

class AdminCommentsController extends ModeratorController
{
    public function edit()
    {
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

        return new View('comment.edit', compact('comments', 'pages', 'itemsOnPage', 'statuses'));
    }

    public function update()
    {
        $comment = Comment::getById($_POST['commentId']);

        $comment->update([
            'status' => $_POST['status']
        ]);
    }

    public function destroy($id)
    {
        Comment::where('id', $id)->delete();
        $_SESSION['success'] = 'Комментарий успешно удален';

        $this->redirect('/admin/comments');
    }
}
