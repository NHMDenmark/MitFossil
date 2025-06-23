<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Era;
use App\Models\Period;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PeriodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periods = Period::with('era')->paginate();
        //
        return Inertia::render('Admin/Periods/Index', compact(
            'periods'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eras = Era::getDropdownQuery()->get();
        return Inertia::render('Admin/Periods/Create', compact('eras'));
    }

    /**
     * Store a newly created resource in storPeriod.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'era_id' => 'required',
        ]);

        Period::create([
            'description' => $request->description,
            'era_id' => $request->era_id,
            'active' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $period = Period::findOrFail($id);

        return Inertia::render('Admin/Periods/Edit', compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $period = Period::findOrFail($id);
        $eras = Era::getDropdownQuery()->get();

        return Inertia::render('Admin/Periods/Edit', compact('period', 'eras'));
    }

    /**
     * Update the specified resource in storPeriod.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'era_id' => 'required',
        ]);

        $period = Period::findOrFail($id);
        $period->description = $request->description;
        $period->era_id = $request->era_id;
        $period->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storPeriod.
     */
    public function destroy(Request $request)
    {
        $model = Period::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.periods.index');
    }
}
