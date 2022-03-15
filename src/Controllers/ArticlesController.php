<?php

namespace App\Controllers;

use App\Models\Article;
use App\Requests\ArticleRequest;
use App\View;

class ArticlesController
{
    public function index()
    {
        $articles = Article::all();
        $title = 'Articles';

        return new View('articles.index', compact('articles', 'title'));
    }

    public function create()
    {
        $title = 'Create article';

        return new View('articles.create', compact('title'));
    }

    public function store()
    {
        // if ($_POST) {
        //     echo '<pre>';
        //     echo htmlspecialchars(print_r($_POST, true));
        //     echo '</pre>';
        // }
        // $validator = $_POST;
        $var = new ArticleRequest();

        // echo '<pre>';
        // print_r($var->validate());
        // echo '</pre>';

        echo '<pre>';
        print_r($var->service());
        echo '</pre>';

        // echo '<pre>';
        // print_r($var->convertRules());
        // echo '</pre>';

        // echo '<pre>';
        // echo htmlspecialchars(print_r($validator, true));
        // echo '</pre>';
        // print_r($articleRequest->validate());
        // echo $articleRequest->var;
        // echo '<pre>';
        // echo (print_r(validate(), true));
        // echo '</pre>';

        // Article::create([
        //     'owner_id' => 1,
        //     'slug' => $_POST['slug'],
        //     'title' => $_POST['title'],
        //     'image' => $_POST['image'],
        //     'description' => $_POST['description'],
        //     'is_published' => $_POST['is_published'],
        // ]);

        // header("Location: http://homeworkcms3");
        // exit();
        //$this->redirect('/');
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
