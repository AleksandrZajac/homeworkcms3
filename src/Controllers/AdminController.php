<?php

namespace App\Controllers;

use App\Exception\NotFoundException;
use App\Config;

class AdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isAdminNotFoundException();
    }

    public static function isAdminNotFoundException()
    {
        if (!$_SESSION['is_admin']) {
            throw new NotFoundException(
                'Нет такого маршрута: ' .
                    Config::getInstance()->getConfig('env')['server']['name'] .
                    $_SERVER['REQUEST_URI']
            );
        }
    }
}
