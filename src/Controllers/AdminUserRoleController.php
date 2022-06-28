<?php

namespace App\Controllers;

use App\Models\User;
use App\View;

class AdminUserRoleController extends AdminController
{
    public function edit()
    {
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = User::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = User::pagination($itemsOnPage);
        }

        $users = $pagination['users'];
        $pages = $pagination['pages'];

        return new View('users.roles', compact('users', 'pages', 'itemsOnPage'));
    }

    public function update()
    {
        $user = User::getById($_POST['userId']);

        $user->update([
            'role_id' => $_POST['roleId']
        ]);

        return $this->json(["Роль пользователя " . $user['email'] . " успешно изменена"]);
    }
}
