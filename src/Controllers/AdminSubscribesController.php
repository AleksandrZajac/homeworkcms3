<?php

namespace App\Controllers;

use App\Models\Subscribe;
use App\Requests\SubscribeRequest;
use App\View;

class AdminSubscribesController extends AdminController
{
    public function edit()
    {
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = Subscribe::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = Subscribe::pagination($itemsOnPage);
        }

        $subscribes = $pagination['subscribes'];
        $pages = $pagination['pages'];

        return new View('subscribes.edit', compact('subscribes', 'pages', 'itemsOnPage'));
    }

    public function destroy($id)
    {
        Subscribe::where('id', $id)->delete();

        $this->redirect('/admin/subscribes');
    }

    public function store()
    {
        $validator = new SubscribeRequest();
        $errors = $validator->errors();

        if (Subscribe::getByEmail($_POST['email'])) {
            $errors[] = 'Пользователь уже подписан';
        } elseif (!$errors) {
            Subscribe::create([
                'email' => $validator->request('email'),
            ]);

            $_SESSION['success'] = 'Добавлен новый подписчик';

            $this->redirect('/admin/subscribes');
        }

        $_SESSION['errors'] = $errors;

        $this->redirect('/admin/subscribes');
    }
}
