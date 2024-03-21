<?php

namespace App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Controller;
use App\Models\Fossil;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function state(Request $request) {
        $myTotalUploads = Fossil::getCount($request->user()->id);
        $myValidatedUploads = Fossil::getCount($request->user()->id, 'validated');
        $myCuratedUploads = Fossil::getCount($request->user()->id, 'curated');

        return compact(
   'myTotalUploads',
 'myValidatedUploads',
           'myCuratedUploads'
        );
    }
}
