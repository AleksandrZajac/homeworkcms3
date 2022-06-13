<?php

namespace App\Controllers;

use App\Models\Subscribe;

class SubscribeController extends BaseController
{
    public function subscribe()
    {
        if (isset($_POST['email'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['message' => 'Ввведите корректный емайл']);
            } else {

                $subscribe = Subscribe::where('email', $_POST['email'])->first();

                if ($subscribe) {

                    echo json_encode(['message' => 'Вы уже подписаны']);
                } else {
                    Subscribe::create([
                        'email' => $_POST['email']
                    ]);

                    $_SESSION['subscribe'] = 1;

                    echo json_encode(['subscribe' => 1]);
                }
            }
        }
    }

    public function destroy()
    {
        $item = Subscribe::where('email', $_POST['email'])->delete();

        echo json_encode(['subscribe' => 0]);
    }
}
