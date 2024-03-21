<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilOrder;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = FossilOrder::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilOrders/Index', compact(
            'orders'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilOrders/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilOrder::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_order = FossilOrder::findOrFail($id);

        return Inertia::render('Admin/FossilOrders/Edit', compact('fossil_order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_order = FossilOrder::findOrFail($id);

        return Inertia::render('Admin/FossilOrders/Edit', compact('fossil_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        $fossil_order = FossilOrder::findOrFail($id);
        $fossil_order->description = $request->description;

        $fossil_order->save();

        return Redirect::route('admin.fossil-orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilOrder::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-orders.index');
    }
}
