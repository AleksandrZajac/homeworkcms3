<?php

namespace App\Controllers;

use App\Models\Article;
use App\View;

class ArticlesController
{
    public function index()
    {
        $articles = Article::all();
        return new View('articles.index', ['title' => 'All articles', 'articles' => $articles]);
    }

    public function create()
    {
        // return view('articles.create');
    }

    public function store($request)
    {
        // Article::create(request()->all());

        // return redirect('/articles');
    }

    public function show(Article $article)
    {
        return new View('articles.show', ['title' => 'Show article', 'article' => $article]);
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
