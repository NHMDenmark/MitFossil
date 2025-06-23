<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilSubspecies;
use App\Models\FossilTaxonomy;
use App\Models\SpecificEpithet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SpecificEpithetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specific_epithet = SpecificEpithet::paginate();

        return Inertia::render('Admin/SpecificEpithets/Index', compact(
            'specific_epithet'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/SpecificEpithets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        SpecificEpithet::create([
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
        $specific_epithet = SpecificEpithet::findOrFail($id);

        return Inertia::render('Admin/SpecificEpithets/Edit', compact('specific_epithet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $specific_epithet = SpecificEpithet::findOrFail($id);

        return Inertia::render('Admin/SpecificEpithets/Edit', compact('specific_epithet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $specific_epithet = SpecificEpithet::findOrFail($id);
        $specific_epithet->description = $request->description;

        $specific_epithet->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = SpecificEpithet::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.specific-epithets.index');
    }
}
