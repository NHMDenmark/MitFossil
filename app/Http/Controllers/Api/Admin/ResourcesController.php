<?php
namespace App\Http\Controllers\Api\Admin;

use App\Core\Functions;
use Illuminate\Http\Request;

class ResourcesController
{
    public function store(Request $request) {
        $image = $request->file('image');
        $name = Functions::uniqidReal(32) . '.' .  $image->getClientOriginalExtension();

        $image->storeAs('public/images', $name);

        return response()->json([
            'path' => '/storage/images/' . $name
        ]);
    }
}
