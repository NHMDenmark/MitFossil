<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilFamily;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilFamiliesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = FossilFamily::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilFamilies/Index', compact(
            'families'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilFamilies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilFamily::create([
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
        $fossil_family = FossilFamily::findOrFail($id);

        return Inertia::render('Admin/FossilFamilies/Edit', compact('fossil_family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_family = FossilFamily::findOrFail($id);

        return Inertia::render('Admin/FossilFamilies/Edit', compact('fossil_family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $fossil_family = FossilFamily::findOrFail($id);
        $fossil_family->description = $request->description;

        $fossil_family->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilFamily::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-families.index');
    }
}
