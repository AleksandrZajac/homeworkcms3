<?php

namespace App\Controllers;

use App\Models\Article;
use App\Requests\ArticleRequest;
use App\View;
use App\Services\FileUpload\File;

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
        $validator = new ArticleRequest();
        $errors = $validator->errors();
        $title = 'Создать статью';

        if (!$errors) {
            $image = new File('image');
            $image->uploadFile();

            Article::create([
                'owner_id' => 1,
                'slug' => $validator->request('slug'),
                'title' => $validator->request('title'),
                'image' => $image->addFileName(),
                'description' => $validator->request('description'),
                'is_published' => $validator->request('is_published'),
            ]);

            return $this->index('Cтатья успешно создана');
        }

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
