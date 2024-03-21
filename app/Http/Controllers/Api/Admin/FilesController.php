<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\File;
use Illuminate\Http\Request;

class FilesController
{
    public function index(Request $request) {
        $files = File::all();

        return $files;
    }
}
