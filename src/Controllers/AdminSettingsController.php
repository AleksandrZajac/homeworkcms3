<?php

namespace App\Controllers;

use App\Services\Settings;
use App\Requests\SettingsRequest;
use App\Exception\UserExceptions;
use App\View;

class AdminSettingsController extends BaseController
{
    public function edit()
    {
        UserExceptions::isAdminNotFoundException();
        $title = 'Настройки';
        $settings = Settings::getSettings();
        $items = $settings['items_on_articles_page'];

        return new View('settings.edit', compact('title', 'items'));
    }

    public function update()
    {
        $validator = new SettingsRequest();
        $errors = $validator->errors();
        Settings::updateSettings();

        if (!$errors) {
            $this->redirect('/');
        }

        $title = 'Настройки';
        $settings = Settings::getSettings();
        $items = $settings['items_on_articles_page'];

        return new View('settings.edit', compact('title', 'items', 'errors'));
    }
}
