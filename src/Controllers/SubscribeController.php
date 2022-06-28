<?php

namespace App\Controllers;

use App\Models\Subscribe;

class SubscribeController extends BaseController
{
    public function subscribe()
    {
        if (isset($_POST['email']) && empty($_POST['email'])) {
            return $this->json(['message' => 'Не задан емайл']);
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json(['message' => 'Ввведите корректный емайл']);
        }

        if (Subscribe::getByEmail($_POST['email'])) {
            return $this->json(['message' => 'Вы уже подписаны']);
        } else {
            Subscribe::create([
                'email' => $_POST['email']
            ]);

            $_SESSION['subscribe'] = 1;


            return $this->json(['subscribe' => 1]);
        }
    }

    public function destroy()
    {
        Subscribe::where('email', $_POST['email'])->delete();

        return $this->json(['subscribe' => 0]);
    }
}
