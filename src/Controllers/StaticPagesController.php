<?php

namespace App\Controllers;

use App\Models\StaticPage;
use App\View;

class StaticPagesController extends BaseController
{
    public function show($slug)
    {
        $page = StaticPage::getBySlug($slug);

        return new View('page.show', compact('page'));
    }
}
