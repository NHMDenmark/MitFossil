<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MapResource;
use App\Models\Page;
use App\Models\Resource;
use Inertia\Inertia;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::getResources();

        return Inertia::render('Customer/Resource/Index', [
            'resources' => $resources ]);
    }

    public function show($endpoint)
    {
        $resource = Resource::getResource($endpoint);
        $resource->childs = Resource::getChilds($resource->id);

        return Inertia::render('Customer/Resource/Show', compact(
            'resource'
        ));
    }

    public function map() {
        $map_resources = MapResource::where('active', true)->get();
        $map_page = Page::find(1);

        return Inertia::render('Customer/Resource/Map', compact(
            'map_resources', 'map_page'
        ));
    }
}
