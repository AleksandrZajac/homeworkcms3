<?php

namespace App;

use function helpers\array_get;

final class Config
{
    private static $instance;
    private static $configs;

    private function __construct()
    {
        self::$configs['db'] = require $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
        self::$configs['uploads_path'] = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    }

    public static function getInstance(): Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getConfig($config, $default = null)
    {
        return array_get(self::$configs, $config) ?? $default;
    }
}
