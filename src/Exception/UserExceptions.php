<?php

namespace App\Exception;

use App\Exception\NotFoundException;
use App\Config;

class UserExceptions
{
    public static function isAdminAndModeratorNotFoundException()
    {
        if (!$_SESSION['is_admin'] && !$_SESSION['is_moderator']) {
            throw new NotFoundException('Нет такого маршрута: ' . Config::getInstance()->getConfig('env')['server']['name'] . $_SERVER['REQUEST_URI']);
        }
    }

    public static function isAdminNotFoundException()
    {
        if (!$_SESSION['is_admin']) {
            throw new NotFoundException('Нет такого маршрута: ' . Config::getInstance()->getConfig('env')['server']['name'] . $_SERVER['REQUEST_URI']);
        }
    }
}
