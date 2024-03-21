<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::whereNull('resource_id')->paginate();

        return Inertia::render('Admin/Resources/Index', compact(
            'resources'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $parent = null;

        if($request->query('resource_id')) {
            $parent = Resource::find($request->query('resource_id'));
        }

        return Inertia::render('Admin/Resources/Create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $request->validate([
            'description' => 'required',
            'name' => 'required',
            'endpoint' => 'required',
            'resource_order' => 'required',
            'html' => 'required',
        ]);

        $endpoint = $request->endpoint;
        if($request->resource_id) {
            $parent = Resource::find($request->resource_id);
            $endpoint = $parent->endpoint . '/' . $endpoint;
        }

        $images = $request->guardarFoto('image', '/images', null);
        $imageValue = is_array($images) ? $images[0] : null;

        $create = Resource::create([
            'resource_id' => $request->resource_id,
            'description' => $request->description,
            'name' => $request->name,
            'endpoint' => $endpoint,
            'resource_order' => $request->resource_order,
            'html' => $request->html,
            'image' => $imageValue,
            'active' => true
        ]);

        if($request->resource_id) {
            return Redirect::route('admin.resources.edit', $request->resource_id);
        }

        return Redirect::route('admin.resources.edit', $create -> id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resource = Resource::findOrFail($id);

        return Inertia::render('Admin/Resources/Edit', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resource = Resource::findResource($id);
        $resource->childs = Resource::getChilds( $resource->id );

        return Inertia::render('Admin/Resources/Edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, $id)
    {
        $resource = Resource::findOrFail($id);
        $oldImage = $resource->image;

        $images = $request->guardarFoto('image', '/images', $oldImage);

        $endpoint = $request->endpoint;
        if($request->resource_id) {
            $parent = Resource::find($request->resource_id);
            $endpoint = $parent->endpoint . '/' . $endpoint;
        }

        $resource->fill($request->all());
        $resource->image = is_array($images) ? $images[0] : $oldImage;
        $resource->endpoint = $endpoint;

        $resource->save();

        /*if($request->resource_id) {
            return Redirect::route('admin.resources.edit', $request->resource_id);
        } else */
        if($id) {
            return Redirect::route('admin.resources.edit', $id);
        }

        return Redirect::route('admin.resources.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = Resource::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.resources.index');
    }
}
