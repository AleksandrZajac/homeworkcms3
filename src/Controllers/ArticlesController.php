<?php

namespace App\Controllers;

use App\Models\Article;
use Symfony\Component\HttpFoundation\Request;
use App\Requests\ArticleRequest;
use App\View;
use App\Image;
use App\Form\FileValidation;

class ArticlesController extends PrivateController
{
    public function index($success = '')
    {
        $articles = Article::all();
        $title = 'Articles';

        return new View('articles.index', compact('articles', 'title', 'success'));
    }

    public function create()
    {
        $title = 'Создать статью';

        return new View('articles.create', compact('title'));
    }

    public function store()
    {
        // echo '<pre>';
        // print_r($_FILES['image']);
        // echo '</pre>';
        // $_POST['image'] = $_FILES['image']['name'];
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // foreach ($_FILES as $key => $value) {
        //     // $path[$key] = $_FILES[$key]['name'];
        //     // $type[$key] = pathinfo($path[$key], PATHINFO_EXTENSION);
        //     // $data[$key] = file_get_contents($path[$key]);
        //     // $base64[$key] = 'data:image/' . $type[$key] . ';base64,' . base64_encode($data[$key]);
        //     // $_POST[$key] = $_FILES[$key]['name'];
        //     // $_POST[$key] = base64_encode(file_get_contents($_FILES[$key]['tmp_name']));
        //     $_POST[$key] = 'ext:png';
        //     // $_POST[$key]['tmp_name'] = $_FILES[$key]['tmp_name'];
        //     // $_POST[$key]['error'] = $_FILES[$key]['error'];
        //     // $_POST[$key]['size'] = $_FILES[$key]['size'];
        // }
        $str = $_FILES['image']['tmp_name'];
        $arr = explode(DIRECTORY_SEPARATOR, $str);
        // $fileName = end($arr);
        // print_r($fileName);
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // $request = Request::createFromGlobals();
        // $request = new FileValidation();

        // echo '<pre>';
        // print_r($request->fileValidation());
        // echo '</pre>';

        $validator = new ArticleRequest();
        $errors = $validator->errors();
        $title = 'Создать статью';

        // print_r($validator->var());
        // exit();

        echo $_SERVER['DOCUMENT_ROOT'] . '/resource/lang';
        echo '<br>';


        // print_r($validator->file('image'));exit();
        // $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
        // $file = $_FILES['image'];

        // $path_parts = pathinfo($_FILES['image']['name']);
        // $ext = $path_parts['extension'];
        // $fileName = $file['name'];
        // $fileName = stristr(str_replace('%', '', rawurlencode($fileName)), '.', true);
        // move_uploaded_file($file['tmp_name'], $path . $fileName . '.' . $ext);
        // $fileName = 'uploads/' . $fileName . '.' . $ext;

        // echo $fileName;

        if (empty($_FILES['image']['error'])) {
            $image = new Image('image');

            $image->uploadFile();
            print_r($image->addFileName());
        }

        // if (!$errors) {
        //     // Article::create([
        //     //     'owner_id' => 1,
        //     //     'slug' => $validator->request('slug'),
        //     //     'title' => $validator->request('title'),
        //     //     'image' => $image->addFileName(),
        //     //     'description' => $validator->request('description'),
        //     //     'is_published' => $validator->request('is_published'),
        //     // ]);
        //     return $this->index('Cтатья успешно создана');
        // }

        return new View('articles.create', compact('title', 'errors', 'validator'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $title = 'Article';

        return new View('articles.show', compact('article', 'title'));
    }

    public function edit($slug)
    {
        // $item = Article::where('slug', $slug)->get();

        // return view('articles.edit', compact('item'));
    }

    public function update($request, $id)
    {
        // $form_data = array(
        //     'user_id' => $user_id,
        //     'order_number'    =>  $request->order_number,
        // );
        // Article::create(request()->all());
        // Article::find($id)->update($form_data);
        // return redirect('/');
    }

    public function destroy($id)
    {
        // $item = Article::find($id);
        // $item->delete();

        // return redirect('/articles');
    }
}
