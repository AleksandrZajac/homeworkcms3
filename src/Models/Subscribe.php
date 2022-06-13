<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribes';

    protected $guarded = [];

    public static function pagination($itemsOnPage)
    {
        $count = Subscribe::all()->count();

        if (isset($_GET['page'])) {
            $skip = ($_GET['page'] - 1) * $itemsOnPage;
        } else {
            $skip = 0;
        }

        if ($itemsOnPage > 0) {
            $pages = ceil($count / $itemsOnPage);
            $subscribes = Subscribe::select(
                'id',
                'email',
                'created_at'
            )
                ->skip($skip)
                ->take($itemsOnPage)
                ->latest()
                ->get();
        } else {
            $pages = 0;
            $subscribes = Subscribe::select(
                'id',
                'email',
                'created_at'
            )
                ->latest()
                ->get();
        }

        $pagintion['pages'] = $pages;
        $pagintion['subscribes'] = $subscribes;

        return $pagintion;
    }
}
