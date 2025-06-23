<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Epoch;
use App\Models\Period;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EpochsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $epochs = Epoch::with('period')->paginate();
        //
        return Inertia::render('Admin/Epochs/Index', compact(
            'epochs'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = Period::getDropdownQuery()->get();
        return Inertia::render('Admin/Epochs/Create', compact('periods'));
    }

    /**
     * Store a newly created resource in storEpoch.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'period_id' => 'required',
        ]);

        Epoch::create([
            'description' => $request->description,
            'period_id' => $request->period_id,
            'active' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $epoch = Epoch::findOrFail($id);

        return Inertia::render('Admin/Epochs/Edit', compact('epoch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $epoch = Epoch::findOrFail($id);
        $periods = Period::getDropdownQuery()->get();

        return Inertia::render('Admin/Epochs/Edit', compact('epoch', 'periods'));
    }

    /**
     * Update the specified resource in storEpoch.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'period_id' => 'required',
        ]);

        $epoch = Epoch::findOrFail($id);
        $epoch->description = $request->description;
        $epoch->period_id = $request->period_id;
        $epoch->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    /**
     * Remove the specified resource from storEpoch.
     */
    public function destroy(Request $request)
    {
        $model = Epoch::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.epochs.index');
    }
}
