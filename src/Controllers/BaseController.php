<?php

namespace App\Controllers;

use App\Models\StaticPage;
use App\JsonView;
use App\Config;

class BaseController
{
    public function __construct()
    {
        $this->startSession();
    }

    public function startSession()
    {
        session_start();
        $_SESSION['pages'] = StaticPage::all();
        $_SESSION['is_admin'] = $this->isAdmin();
        $_SESSION['is_moderator'] = $this->isModerator();
        $_SESSION['is_auth'] = $this->isAuth();
    }

    public function closeSession()
    {
        session_destroy();
        setcookie('login', '', 1, '/');
        setcookie('user_id', '', 1, '/');
        unset($_SESSION['login']);
        unset($_SESSION['user_id']);
        header("Location: /");
        exit();
    }

    public function json(array $data)
    {
        return new JsonView($data);
    }

    public function redirect($uri)
    {
        header("Location: " . $uri);
        exit();
    }

    public function isAdmin()
    {
        if (isset($_SESSION['login'])) {

            return $_SESSION['role_id'] == Config::getInstance()->getConfig('env')['user_role']['admin'];
        }
    }

    public function isModerator()
    {
        if (isset($_SESSION['login'])) {

            return $_SESSION['role_id'] == Config::getInstance()->getConfig('env')['user_role']['moderator'];
        }
    }

    public function isAuth()
    {
        if (isset($_SESSION['login'])) {
            return $_SESSION['is_auth'] = true;
        }

        return $_SESSION['is_auth'] = false;
    }
}
