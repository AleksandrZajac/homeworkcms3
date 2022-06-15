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
        $validator = new LoginRequest();
        $errors = $validator->errors();
        $old = $_POST;

        $user = new User();
        $isAuth = $user->authorized(
            $validator->request('email'),
            $validator->request('password')
        );

        if (!$isAuth) {
            $errors[] = 'Wrong password or email';
        } else {
            $this->redirect('/');
        }

        return new View('authorization.login', compact('errors', 'old'));
    }

    public function showLoginForm()
    {
        return new View('authorization.login');
    }
}
