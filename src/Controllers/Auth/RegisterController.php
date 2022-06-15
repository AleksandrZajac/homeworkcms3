<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Requests\RegisterRequest;
use App\Controllers\BaseController;
use App\Config;
use App\View;

class RegisterController extends BaseController
{
    public function create()
    {
        $validator = new RegisterRequest();
        $errors = $validator->errors();
        $old = $_POST;

        if ($validator->request('password') !== $validator->request('password2')) {
            $errors[] = 'Passwords do not match';
        }

        if (!$errors) {
            User::create([
                'name' => $validator->request('name'),
                'email' => $validator->request('email'),
                'password' => password_hash($validator->request('password'), PASSWORD_DEFAULT),
                'role_id' => Config::getInstance()->getConfig('env')['user_role']['auth_user'],
            ]);

            $user = new User();

            $user->authorized($validator->request('email'), $validator->request('password'));

            $this->redirect('/');
        }

        return new View('authorization.register', compact('errors', 'old'));
    }

    public function showRegisterForm()
    {
        return new View('authorization.register');
    }

    public function logout()
    {
        $this->closeSession();

        $this->redirect('/');
    }
}
