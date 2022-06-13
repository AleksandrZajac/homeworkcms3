<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\Queries\GetArticleComments;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $guarded = [];

    public static function pagination($itemsOnPage)
    {
        $count = Comment::all()->count();

        if (isset($_GET['page'])) {
            $skip = ($_GET['page'] - 1) * $itemsOnPage;
        } else {
            $skip = 0;
        }

        if ($itemsOnPage > 0) {
            $pages = ceil($count / $itemsOnPage);
            $comments = Comment::select(
                'comments.id',
                'comments.description',
                'comments.created_at',
                'comments.status',
                'users.email'
            )
                ->join('users', 'user_id', '=', 'users.id')
                ->skip($skip)
                ->take($itemsOnPage)
                ->latest()
                ->get();
        } else {
            $pages = 0;
            $comments = Comment::select(
                'comments.description',
                'comments.created_at',
                'comments.status',
                'users.email'
            )
                ->join('users', 'user_id', '=', 'users.id')
                ->latest()
                ->get();
        }

        $pagintion['pages'] = $pages;
        $pagintion['comments'] = $comments;

        return $pagintion;
    }
}
