<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilRegion;
use App\Models\FossilSpeciality;
use App\Models\FossilTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilSpecialiesController extends Controller
{
    public function index()
    {
        $fossil_speciality = FossilSpeciality::paginate();

        return Inertia::render('Admin/FossilSpecialities/Index', compact(
            'fossil_speciality'
        ));
    }

    public function create()
    {

        return Inertia::render('Admin/FossilSpecialities/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilSpeciality::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-speciality.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_speciality = FossilSpeciality::findOrFail($id);

        return Inertia::render('Admin/FossilSpecialities/Edit', compact('fossil_speciality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_speciality = FossilSpeciality::findOrFail($id);

        return Inertia::render('Admin/FossilSpecialities/Edit', compact('fossil_speciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        $fossil_speciality = FossilSpeciality::findOrFail($id);
        $fossil_speciality->description = $request->description;

        $fossil_speciality->save();

        return Redirect::route('admin.fossil-speciality.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilSpeciality::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-speciality.index');
    }

}
