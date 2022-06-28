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

        if (Subscribe::getByEmail($_SESSION['login'])) {
            $_SESSION['subscribe'] = 1;
        }

        $old = User::getById($id);
        $avatar = '/uploads/1651749061.png';

        if ($old->avatar) {
            $avatar = $old->avatar;
        }

        return new View('personal.area.show', compact('old', 'avatar'));
    }

    public function update($id)
    {
        $article = User::getById($id);
        $validator = new PersonalAreaRequest($id);
        $errors = $validator->errors();

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

            $this->redirect('/user/id/' . $id);
        }

        return new View('personal.area.show', compact('errors'));
    }
}
