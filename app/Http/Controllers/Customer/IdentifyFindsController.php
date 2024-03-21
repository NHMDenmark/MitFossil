<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Fossil;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IdentifyFindsController extends Controller
{
    public function index(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $search = $request->query('search');
        $curators = User::getDropdownCurators();
        $origin = 'identify-find';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/Identify/Index', compact(
            'taxonomies', 'ages', 'search', 'taxonomies_wizzard', 'curators', 'fossil', 'origin'
        ));
    }
}
