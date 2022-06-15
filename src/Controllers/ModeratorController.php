<?php

namespace App\Controllers;

use App\Exception\NotFoundException;
use App\Config;

class ModeratorController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isAdminAndModeratorNotFoundException();
    }

    public static function isAdminAndModeratorNotFoundException()
    {
        if (!$_SESSION['is_admin'] && !$_SESSION['is_moderator']) {
            throw new NotFoundException(
                'Нет такого маршрута: ' .
                    Config::getInstance()->getConfig('env')['server']['name'] .
                    $_SERVER['REQUEST_URI']
            );
        }
    }
}
