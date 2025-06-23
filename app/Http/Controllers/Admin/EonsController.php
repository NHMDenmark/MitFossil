<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eon;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eons = Eon::paginate();
        //
        return Inertia::render('Admin/Eons/Index', compact(
            'eons'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Eons/Create');
    }

    /**
     * Store a newly created resource in storEon.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        Eon::create([
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
        $eon = Eon::findOrFail($id);

        return Inertia::render('Admin/Eons/Edit', compact('eon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eon = Eon::findOrFail($id);

        return Inertia::render('Admin/Eons/Edit', compact('eon'));
    }

    /**
     * Update the specified resource in storEon.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $eon = Eon::findOrFail($id);
        $eon->description = $request->description;
        $eon->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storEon.
     */
    public function destroy(Request $request)
    {
        $model = Eon::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.eons.index');
    }
}
