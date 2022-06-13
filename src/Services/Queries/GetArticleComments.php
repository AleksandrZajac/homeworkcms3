<?php

namespace App\Services\Queries;

use Illuminate\Database\Capsule\Manager as DB;

class GetArticleComments
{
    public static function getComments($articleId)
    {
        $comments = DB::table('articles')
            ->select(
                'comments.id',
                'comments.description',
                'comments.created_at',
                'comments.updated_at',
                'comments.status',
                'users.id as user_id',
                'users.name',
                'users.avatar'
            )
            ->join('comments', 'article_id', '=', 'articles.id')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('article_id', '=', $articleId)
            ->latest()
            ->get();

        return $comments;
    }
}
