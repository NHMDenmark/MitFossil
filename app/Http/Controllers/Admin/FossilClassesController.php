<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopyrightRule;
use App\Models\FossilClass;
use App\Models\FossilTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = FossilClass::query()->orderBy('description', 'asc')->paginate();
        //
        return Inertia::render('Admin/FossilClasses/Index', compact(
            'classes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilClasses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilClass::create([
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
        $fossil_class = FossilClass::findOrFail($id);

        return Inertia::render('Admin/FossilClasses/Edit', compact('fossil_class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_class = FossilClass::findOrFail($id);

        return Inertia::render('Admin/FossilClasses/Edit', compact('fossil_class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $fossil_class = FossilClass::findOrFail($id);
        $fossil_class->description = $request->description;

        $fossil_class->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilClass::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.fossil-classes.index');
    }
}
