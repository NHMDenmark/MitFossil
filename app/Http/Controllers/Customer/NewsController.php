<?php

namespace App\Http\Controllers\Customer;

use App\Models\News;
use Inertia\Inertia;

class NewsController
{
    public function show($endpoint)
    {
        $news = News::getNew($endpoint);

        return Inertia::render('Customer/News/Show', compact(
            'news'
        ));
    }
}
