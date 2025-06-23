<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapResource;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MapResourcesController extends Controller
{
    function index(Request $request){
        $mapResources = MapResource::paginate();
        $page = Page::find(1);

        return Inertia::render('Admin/MapResources/Index',
            compact('mapResources', 'page'));
    }
    public function create()
    {
        ;
        return Inertia::render('Admin/MapResources/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        MapResource::create([
            'title' => $request->title,
            'text' => $request->text,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'active' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    public function edit($id)
    {
        $mapResource = MapResource::findOrFail($id);

        return Inertia::render('Admin/MapResources/Edit', compact('mapResource'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $mapResource = MapResource::findOrFail($id);
        $mapResource->title= $request->title;
        $mapResource->text= $request->text;
        $mapResource->latitude= $request->latitude;
        $mapResource->longitude= $request->longitude;

        $mapResource->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    public function destroy(Request $request)
    {
        $model = MapResource::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.map-resources.index');
    }

    public function savePage(Request $request) {

    }
}
