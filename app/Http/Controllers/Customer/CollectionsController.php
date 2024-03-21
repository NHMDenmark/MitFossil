<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Fossil;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CollectionsController extends Controller
{
    public function index(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $search = $request->query('search');
        $origin = 'my-collection';
        $curators = User::getDropdownCurators();

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/MyCollections/Index', compact(
            'taxonomies', 'ages', 'search', 'curators', 'taxonomies_wizzard', 'fossil', 'origin'
        ));
    }
}
