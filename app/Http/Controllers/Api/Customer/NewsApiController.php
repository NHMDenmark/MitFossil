<?php
namespace App\Http\Controllers\Api\Customer;

use App\Models\News;

class NewsApiController
{
    public function index()
    {
        $news = News::getNews();

        return response()->json([
            'news' => $news
        ]);
    }
}
