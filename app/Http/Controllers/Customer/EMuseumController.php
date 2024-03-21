<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Fossil;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EMuseumController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Customer/EMuseum/Index');
    }

    public function curated(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $curators = User::getDropdownCurators();
        $search = $request->query('search');
        $origin = 'curated';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/EMuseum/Curated', compact(
            'taxonomies', 'ages', 'search', 'origin', 'taxonomies_wizzard', 'curators', 'fossil', 'origin'
        ));
    }

    public function experts(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $curators = User::getDropdownCurators();
        $search = $request->query('search');
        $origin = 'experts';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/EMuseum/Experts', compact(
            'taxonomies', 'ages', 'search', 'origin', 'taxonomies_wizzard', 'curators', 'fossil', 'origin'
        ));
    }

    public function fossil_experts(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $curators = User::getDropdownCurators();
        $search = $request->query('search');
        $origin = 'fossil-experts';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/EMuseum/FossilExperts', compact(
            'taxonomies', 'ages', 'search', 'origin', 'taxonomies_wizzard', 'curators', 'fossil', 'origin'
        ));
    }

    public function map(Request $request) {
        $taxonomies = FossilTaxonomy::getGroupDropdown();
        $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();
        $ages = Age::getGroupDropdown();
        $curators = User::getDropdownCurators();
        $search = $request->query('search');
        $origin = 'map';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        return Inertia::render('Customer/EMuseum/Map', compact(
            'taxonomies', 'ages', 'search', 'origin', 'taxonomies_wizzard', 'curators', 'fossil', 'origin'
        ));
    }
}
