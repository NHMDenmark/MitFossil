<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eon;
use App\Models\Era;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ErasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eras = Era::with('eon')->paginate();
        //
        return Inertia::render('Admin/Eras/Index', compact(
            'eras'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eons = Eon::getDropdownQuery()->get();

        return Inertia::render('Admin/Eras/Create', compact('eons'));
    }

    /**
     * Store a newly created resource in storEra.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'eon_id' => 'required',
        ]);

        Era::create([
            'description' => $request->description,
            'eon_id' => $request->eon_id,
            'active' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $era = Era::findOrFail($id);

        return Inertia::render('Admin/Eras/Edit', compact('era'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $era = Era::findOrFail($id);
        $eons = Eon::getDropdownQuery()->get();

        return Inertia::render('Admin/Eras/Edit', compact('era', 'eons'));
    }

    /**
     * Update the specified resource in storEra.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'eon_id' => 'required',
        ]);

        $era = Era::findOrFail($id);
        $era->description = $request->description;
        $era->eon_id = $request->eon_id;
        $era->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storEra.
     */
    public function destroy(Request $request)
    {
        $model = Era::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.eras.index');
    }
}
