<?php

namespace App\Controllers;

use App\Models\StaticPage;
use App\View;

class StaticPagesController extends BaseController
{
    public function show($slug)
    {
        $page = StaticPage::where('slug', $slug)->first();
        $allPages = StaticPage::all();

        return new View('page.show', compact('page', 'allPages'));
    }
}
