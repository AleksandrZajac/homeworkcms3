<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Requests\LoginRequest;
use App\Controllers\BaseController;
use App\View;

class LoginController extends BaseController
{
    public function checkUser()
    {
        $title = 'Логин';
        $validator = new LoginRequest();
        $errors = $validator->errors();
        $old = $_POST;

        $user = new User();
        $isAuth = $user->authorized($validator->request('email'), $validator->request('password'));

        if (!$isAuth) {
            $errors[] = 'Wrong password or email';
        } else {
            $this->redirect('/');
        }

        return new View('authorization.login', compact('title', 'errors', 'old'));
    }

    public function showLoginForm()
    {
        $title = 'Login';

        return new View('authorization.login', compact('title'));
    }
}
