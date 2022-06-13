<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function pagination($take)
    {
        $count = StaticPage::all()->count();
        $pages = ceil($count / $take);

        if (isset($_GET['page'])) {
            $skip = ($_GET['page'] - 1) * $take;
            $staticPages = StaticPage::select()->skip($skip)->take($take)->latest()->get();
        } else {
            $staticPages = StaticPage::select()->skip(0)->take($take)->latest()->get();
        }

        $pagintion['pages'] = $pages;
        $pagintion['static-pages'] = $staticPages;

        return $pagintion;
    }
}
