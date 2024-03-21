<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the News.
     */
    public function index()
    {
        $news = News::paginate();

        return Inertia::render('Admin/News/Index', compact(
            'news'
        ));
    }

    /**
     * Show the form for creating a new News.
     */
    public function create()
    {
        return Inertia::render('Admin/News/Create');
    }

    /**
     * Store a newly created News in storage.
     */
    public function store(NewsRequest $request)
    {
        $data = $request->all();
        $news = new News($data);
        $urlImages = $request->guardarFoto('image', '/images', null);
        $news->image = isset($urlImages) && is_array($urlImages) ? $urlImages[0] : $urlImages;
        $news->active = 1;
        $news->save();
        return Redirect::route('admin.news.index');
    }

    /**
     * Display the specified News.
     */
    public function show($id)
    {
        $news = News::findOrFail($id);

        return Inertia::render('Admin/News/Edit', compact('news'));
    }

    /**
     * Show the form for editing the specified News.
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);

        return Inertia::render('Admin/News/Edit', compact('news'));
    }

    /**
     * Update the specified News in storage.
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $old_image = $news->image;
        $news->fill($request->all());

        $urlImages = $request->guardarFoto('image', '/images', $old_image);
        $news->image = isset($urlImages) && is_array($urlImages) ? $urlImages[0] : $urlImages;

        $news->save();

        return Redirect::route('admin.news.index');
    }

    /**
     * Remove the specified News from storage.
     */
    public function destroy(Request $request)
    {
        $model = News::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.news.index');
    }
}
