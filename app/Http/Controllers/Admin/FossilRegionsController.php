<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilRegion;
use App\Models\FossilTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilRegionsController extends Controller
{
    public function index()
    {
        $fossilRegion = FossilRegion::paginate();

        return Inertia::render('Admin/FossilRegions/Index', compact(
            'fossilRegion'
        ));
    }

    public function create()
    {

        return Inertia::render('Admin/FossilRegions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilRegion::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossilRegion = FossilRegion::findOrFail($id);

        return Inertia::render('Admin/FossilRegions/Edit', compact('fossilRegion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossilRegion = FossilRegion::findOrFail($id);

        return Inertia::render('Admin/FossilRegions/Edit', compact('fossilRegion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $fossil_regions = FossilRegion::findOrFail($id);
        $fossil_regions->description = $request->description;

        $fossil_regions->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilRegion::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-region.index');
    }

}
