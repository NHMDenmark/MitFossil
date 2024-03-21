<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilPhylum;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilPhylumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phylums = FossilPhylum::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilPhylums/Index', compact(
            'phylums'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilPhylums/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilPhylum::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-phylums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_phylum = FossilPhylum::findOrFail($id);

        return Inertia::render('Admin/FossilPhylums/Edit', compact('fossil_phylum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_phylum = FossilPhylum::findOrFail($id);

        return Inertia::render('Admin/FossilPhylums/Edit', compact('fossil_phylum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        $fossil_phylum = FossilPhylum::findOrFail($id);
        $fossil_phylum->description = $request->description;

        $fossil_phylum->save();

        return Redirect::route('admin.fossil-phylums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilPhylum::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-phylums.index');
    }
}
