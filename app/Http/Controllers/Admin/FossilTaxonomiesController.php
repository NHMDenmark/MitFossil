<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FossilClass;
use App\Models\FossilCommon;
use App\Models\FossilGenre;
use App\Models\FossilKingdom;
use App\Models\FossilOrder;
use App\Models\FossilFamily;
use App\Models\FossilPhylum;
use App\Models\FossilSubgenre;
use App\Models\FossilSubspecies;
use App\Models\FossilTaxonomy;
use App\Models\SpecificEpithet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FossilTaxonomiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $taxonomies = FossilTaxonomy::query()->orderBy('description', 'asc')->paginate();

        return Inertia::render('Admin/FossilTaxonomies/Index', compact(
            'taxonomies'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commons = FossilCommon::getDropdownQuery()->get();
        $kingdoms = FossilKingdom::getDropdownQuery()->get();
        $phylums = FossilPhylum::getDropdownQuery()->get();
        $classes = FossilClass::getDropdownQuery()->get();
        $orders = FossilOrder::getDropdownQuery()->get();
        $families = FossilFamily::getDropdownQuery()->get();
        $genres = FossilGenre::getDropdownQuery()->get();
        $subgenres = FossilSubgenre::getDropdownQuery()->get();
        $specific_epithets = SpecificEpithet::getDropdownQuery()->get();
        $subspecies = FossilSubspecies::getDropdownQuery()->get();

        return Inertia::render('Admin/FossilTaxonomies/Create', compact(
            'commons',
            'kingdoms',
            'phylums',
            'classes',
            'orders',
            'families',
            'genres',
            'subgenres',
            'specific_epithets',
            'subspecies'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        FossilTaxonomy::create([
            'description' => $request->description,
            'fossil_kingdom_id' => $request->fossil_kingdom_id,
            'fossil_common_id' => $request->fossil_common_id,
            'fossil_phylum_id' => $request->fossil_phylum_id,
            'fossil_class_id' => $request->fossil_class_id,
            'fossil_order_id' => $request->fossil_order_id,
            'fossil_family_id' => $request->fossil_family_id,
            'fossil_genre_id' => $request->fossil_genre_id,
            'fossil_subgenre_id' => $request->fossil_subgenre_id,
            'specific_epithet_id' => $request->specific_epithet_id,
            'fossil_subspecies_id' => $request->fossil_subspecies_id,
            'active' => true
        ]);

        return Redirect::route('admin.fossil-taxonomies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fossil_taxonomy = FossilTaxonomy::findOrFail($id);

        return Inertia::render('Admin/FossilTaxonomies/Edit', compact('fossil_taxonomy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $fossil_taxonomy = FossilTaxonomy::findOrFail($id);

        $commons = FossilCommon::getDropdownQuery()->get();
        $kingdoms = FossilKingdom::getDropdownQuery()->get();
        $phylums = FossilPhylum::getDropdownQuery()->get();
        $classes = FossilClass::getDropdownQuery()->get();
        $orders = FossilOrder::getDropdownQuery()->get();
        $families = FossilFamily::getDropdownQuery()->get();
        $genres = FossilGenre::getDropdownQuery()->get();
        $subgenres = FossilSubgenre::getDropdownQuery()->get();
        $specific_epithets = SpecificEpithet::getDropdownQuery()->get();
        $subspecies = FossilSubspecies::getDropdownQuery()->get();

        return Inertia::render('Admin/FossilTaxonomies/Edit', compact(
            'fossil_taxonomy',
            'commons',
            'kingdoms',
            'phylums',
            'classes',
            'orders',
            'families',
            'genres',
            'subgenres',
            'specific_epithets',
            'subspecies'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $fossil_taxonomy = FossilTaxonomy::findOrFail($id);
        //$fossil_taxonomy->fill($request->all());

        $fossil_taxonomy->description = $request->description;
        $fossil_taxonomy->fossil_kingdom_id = $request->fossil_kingdom_id;
        $fossil_taxonomy->fossil_common_id = $request->fossil_common_id;
        $fossil_taxonomy->fossil_phylum_id = $request->fossil_phylum_id;
        $fossil_taxonomy->fossil_class_id = $request->fossil_class_id;
        $fossil_taxonomy->fossil_order_id = $request->fossil_order_id;
        $fossil_taxonomy->fossil_family_id = $request->fossil_family_id;
        $fossil_taxonomy->fossil_genre_id = $request->fossil_genre_id;
        $fossil_taxonomy->specific_epithet_id = $request->specific_epithet_id;

        $fossil_taxonomy->save();

        return Redirect::route('admin.fossil-taxonomies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $model = FossilTaxonomy::findOrFail($request->id);

        if ($request->action === 'change-status') {
            $model->active = !$model->active;
            $model->save();
        } else if ($request->action === 'delete') {
            $model->delete();
        }

        return Redirect::route('admin.fossil-taxonomies.index');
    }
}
