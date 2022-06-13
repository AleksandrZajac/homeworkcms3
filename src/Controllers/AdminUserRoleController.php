<?php

namespace App\Controllers;

use App\Models\User;
use App\View;
use App\Exception\UserExceptions;

class AdminUserRoleController extends BaseController
{
    public function edit()
    {
        UserExceptions::isAdminNotFoundException();
        $title = 'Пользователи';
        $itemsOnPage = 20;

        if (isset($_GET['itemsOnPage'])) {
            $pagination = User::pagination($_GET['itemsOnPage']);
            $itemsOnPage = $_GET['itemsOnPage'];
        } else {
            $pagination = User::pagination($itemsOnPage);
        }

        $users = $pagination['users'];
        $pages = $pagination['pages'];

        return new View('users.roles', compact('users', 'pages', 'title', 'itemsOnPage'));
    }

    public function update()
    {
        $user = User::where('id', $_POST['userId'])->first();

        $user->update([
            'role_id' => $_POST['roleId']
        ]);

        echo json_encode("Роль пользователя " . $user['email'] . " успешно изменена");
    }
}
