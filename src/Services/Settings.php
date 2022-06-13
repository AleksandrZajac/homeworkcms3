<?php

namespace App\Services;

class Settings
{
    public static function getSettings()
    {
        $filename = 'configs/settings';
        $data = file_get_contents($filename);
        $settings = json_decode($data, TRUE);

        return $settings;
    }

    public static function updateSettings()
    {
        $filename = 'configs/settings';
        $data = file_get_contents($filename);
        $configSettings = json_decode($data, TRUE);
        $_POST['items'] ? $settings['items_on_articles_page'] = $_POST['items'] : $settings['items_on_articles_page'] = $configSettings['items_on_articles_page'];
        $data = json_encode($settings);
        file_put_contents($filename, $data);
    }
}
