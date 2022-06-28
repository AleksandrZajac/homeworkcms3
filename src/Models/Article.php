<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function pagination($take, $isPublished = 0)
    {
        $isPublished ? $count = Article::where('is_published', 1)->count() : $count = Article::all()->count();

        if ($take > 0) {
            $pages = ceil($count / $take);
        } else {
            $pages = 0;
        }

        if ($isPublished) {

            if (isset($_GET['page'])) {
                $skip = ($_GET['page'] - 1) * $take;
                $articles = Article::select()->where('is_published', 1)->skip($skip)->take($take)->latest()->get();
            } else {
                $articles = Article::select()->where('is_published', 1)->skip(0)->take($take)->latest()->get();
            }

            $pagintion['pages'] = $pages;
            $pagintion['articles'] = $articles;

            return $pagintion;
        }

        if (isset($_GET['page'])) {
            $skip = ($_GET['page'] - 1) * $take;
            $articles = Article::select()->skip($skip)->take($take)->latest()->get();
        } else {
            $articles = Article::select()->skip(0)->take($take)->latest()->get();
        }

        $pagintion['pages'] = $pages;
        $pagintion['articles'] = $articles;

        return $pagintion;
    }

    public static function getById($id)
    {
        return Article::where('id', $id)->first();
    }

    public static function getBySlug($slug, $isPublished = 0)
    {
        if (!$isPublished) {
            return Article::where('slug', $slug)->first();
        }
        return Article::where([
            ['slug', $slug],
            ['is_published', $isPublished]
            ])->first();
    }
}
