<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Epoch;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AgesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ages = Age::with('epoch')->paginate();
        //
        return Inertia::render('Admin/Ages/Index', compact(
            'ages'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $epochs = Epoch::getDropdownQuery()->get();

        return Inertia::render('Admin/Ages/Create', compact('epochs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'epoch_id' => 'required',
        ]);

        Age::create([
            'description' => $request->description,
            'epoch_id' => $request->epoch_id,
            'active' => true
        ]);

        return Redirect::route('admin.ages.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $age = Age::findOrFail($id);

        return Inertia::render('Admin/Ages/Edit', compact('age'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $age = Age::findOrFail($id);
        $epochs = Epoch::getDropdownQuery()->get();

        return Inertia::render('Admin/Ages/Edit', compact('age', 'epochs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'epoch_id' => 'required',
        ]);
        
        $age = Age::findOrFail($id);
        $age->description = $request->description;
        $age->epoch_id = $request->epoch_id;
        $age->save();

        return Redirect::route('admin.ages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = Age::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }

        return Redirect::route('admin.ages.index');
    }
}
