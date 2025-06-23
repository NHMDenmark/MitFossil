<?php
namespace App\Http\Controllers\Admin;

use App\Core\Functions;
use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function index() {
        $files = File::paginate();

        return Inertia::render('Admin/Files/Index', compact(
            'files'
        ));
    }

    public function create() {
        return Inertia::render('Admin/Files/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'file' => 'required',
        ]);

        $file = $request->file('file');

        if($file->isValid()) {
            $extension = $file->extension();
            $size = $file->getSize();
            $name = Functions::uniqidReal(32) . '.' . $extension;

            $file->move(storage_path('app/public/files'), $name);

            File::create([
                'name' => $request->name,
                'path' =>  '/files/' . $name,
                'size' => $size
            ]);
        }

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    public function edit(Request $request, $id) {
        $file = File::find($id);

        return Inertia::render('Admin/Files/Edit', compact('file'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $model = File::find($request->id);

        if($file !== null && $file->isValid()) {
            $extension = $file->extension();
            $size = $file->getSize();
            $name = Functions::uniqidReal(32) . '.' . $extension;

            $file->move(storage_path('app/public/files'), $name);

            if (file_exists(storage_path('app/public') . $model->path)) {
                unlink(storage_path('app/public') . $model->path);
            }

            $model->fill([
                'name' => $request->name,
                'path' =>  '/files/' . $name,
                'size' => $size
            ]);

            $model->save();
        }

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    public function destroy(Request $request)
    {
        $model = File::findOrFail($request->id);

        if (file_exists(storage_path('app/public') . $model->path)) {
            unlink(storage_path('app/public') . $model->path);
        }

        $model->delete();
        return Redirect::route('admin.files.index');
    }
}
