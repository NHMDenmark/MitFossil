<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Fossil;
use App\Models\FossilTaxonomy;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $myCollections = null;
        $cantTodayUploadsFossils = Fossil::getCount(null, 'today');
        $cantTotalFossils = Fossil::getCount(null);
        $user_id = null;

       if($request->user()){
           $user_id = $request->user()->id;
           $myCollections = Fossil::getCollection($request->user()->id, 3, 'my-collection');
       }

       $uploadsFossils = Fossil::getCollection(null,3, 'uploads');
       $identityFossils = Fossil::getCollection($user_id, 3, 'identify');
       $cantMembers = User::getCantMembers();
       $curators = User::getDropdownCurators();
       $origin = 'dashboard';
       $taxonomies_wizzard = FossilTaxonomy::getTaxonomies();

       $fossil = null;

       if($request->user() !== null && $request->query('fossil')) {
           $fossil_id = $request->query('fossil');
           $fossil = Fossil::getFossil($fossil_id);
       }

       return Inertia::render('Customer/Dashboard/Index', compact(
        'myCollections',
      'uploadsFossils',
                'cantTodayUploadsFossils',
                'cantTotalFossils',
                'cantMembers',
                'identityFossils',
                'fossil',
                'curators',
                'taxonomies_wizzard',
                'origin'
        ));
    }
}
