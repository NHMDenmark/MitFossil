<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilClass;
use App\Models\FossilCommon;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilCommonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commons = FossilCommon::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilCommons/Index', compact(
            'commons'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilCommons/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilCommon::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-commons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_class = FossilCommon::findOrFail($id);

        return Inertia::render('Admin/FossilCommons/Edit', compact('fossil_class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_common = FossilCommon::findOrFail($id);

        return Inertia::render('Admin/FossilCommons/Edit', compact('fossil_common'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        $fossil_common = FossilCommon::findOrFail($id);
        $fossil_common->description = $request->description;

        $fossil_common->save();

        return Redirect::route('admin.fossil-commons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilCommon::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-commons.index');
    }
}
