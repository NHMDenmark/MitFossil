<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilSubspecies;
use App\Models\FossilTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilSubspeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subspecies = FossilSubspecies::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilSubspecies/Index', compact(
            'subspecies'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilSubspecies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilSubspecies::create([
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
        $fossil_subspecies = FossilSubspecies::findOrFail($id);

        return Inertia::render('Admin/FossilSubspecies/Edit', compact('fossil_subspecies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_subspecies = FossilSubspecies::findOrFail($id);

        return Inertia::render('Admin/FossilSubspecies/Edit', compact('fossil_subspecies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $fossil_subspecies = FossilSubspecies::findOrFail($id);
        $fossil_subspecies->description = $request->description;

        $fossil_subspecies->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilSubspecies::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-subspecies.index');
    }
}
