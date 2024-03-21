<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    public function store(Request $request)
    {
        $page = Page::find(1);
        $page->title = $request->title;
        $page->text = $request->text;

        $page->save();

        $route = match ($request->origin) {
            'map-resource' => 'admin.map-resources.index',
            default => 'admin.dashboard'
        };

        return Redirect::route($route);
    }
}
