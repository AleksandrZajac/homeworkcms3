<?php

namespace App\Controllers;

use App\Models\User;
use App\View;
use App\Services\FileUpload\File;
use App\Requests\PersonalAreaRequest;
use App\Models\Subscribe;

class PersonalAreaController extends BaseController
{
    public function show($id)
    {
        $_SESSION['subscribe'] = 0;
        $title = 'Личный кабинет';

        if (Subscribe::where('email', $_SESSION['login'])->first()) {
            $_SESSION['subscribe'] = 1;
        }

        $old = User::where('id', $id)->first();

        return new View('personal.area.show', compact('old', 'title'));
    }

    public function update($id)
    {
        $article = User::where('id', $id)->first();
        $validator = new PersonalAreaRequest($id);
        $errors = $validator->errors();
        $title = 'Личный кабинет';
        $old = $_POST;

        if (!$errors) {
            $image = new File('avatar');

            if ($image->error) {
                $article->update([
                    'annotation' => $validator->request('annotation'),
                ]);
            } else {
                $image->uploadFile();

                $article->update([
                    'avatar' => $image->addFileName(),
                    'annotation' => $validator->request('annotation'),
                ]);
            }

            $_SESSION['success'] = 'Статья успешно обновлена';

            $this->redirect("/user/id/$id");
        }

        return new View('personal.area.show', compact('title', 'errors'));
    }
}
