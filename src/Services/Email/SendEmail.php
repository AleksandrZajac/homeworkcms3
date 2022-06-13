<?php

namespace App\Services\Email;

use App\Models\Subscribe;

class SendEmail
{
    public static function sendNotification($title, $shortDescription, $slug)
    {
        $subscribe = Subscribe::all();
        foreach ($subscribe as $key => $value) {
            $date = date('Y-m-d H:i:s');
            $email = $value->email . PHP_EOL;
            $header = 'Заголовок письма: На сайте добавлена новая запись: ' . $title . PHP_EOL;
            $text = "Содержимое письма:" . PHP_EOL;
            $newArticle = 'Новая статья: ' . PHP_EOL . $title . PHP_EOL;
            $description = 'Краткое описание статьи: ' . PHP_EOL . $shortDescription . PHP_EOL;
            $link = 'Читать http://' . $_SERVER['SERVER_NAME'] . '/articles/' . $slug . PHP_EOL;
            $unsubscribe = 'Отписаться: http://' . $_SERVER['HTTP_HOST'] . '/admin/subscribes/' . $slug . '/delete' . PHP_EOL;
            $emailMessage = $date . $email . $header . $text . $newArticle . $shortDescription . $link . $unsubscribe;

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.txt', $emailMessage . PHP_EOL, FILE_APPEND);
        }
    }
}
