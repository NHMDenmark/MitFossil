<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilGenre;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilGenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = FossilGenre::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilGenres/Index', compact(
            'genres'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FossilGenres/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilGenre::create([
            'description' => $request->description,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-genres.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_genre = FossilGenre::findOrFail($id);

        return Inertia::render('Admin/FossilGenres/Edit', compact('fossil_genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_genre = FossilGenre::findOrFail($id);

        return Inertia::render('Admin/FossilGenres/Edit', compact('fossil_genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);
        
        $fossil_genre = FossilGenre::findOrFail($id);
        $fossil_genre->description = $request->description;

        $fossil_genre->save();

        return Redirect::route('admin.fossil-genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilGenre::findOrFail($request->id);

        if($request->action === 'change-status'){
            $model->active= !$model->active;
            $model->save();
        } else if($request->action === 'delete'){
            $model->delete();
        }
        return Redirect::route('admin.fossil-genres.index');
    }
}
