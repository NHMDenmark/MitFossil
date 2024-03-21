<?php

namespace App\Http\Controllers\Admin;

use App\Core\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdminRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UsersController extends Controller
{
    function index(Request $request) {
        $users = User::getUserAdmin(true);

        $user_delete = null;
        if($request->query('user_delete_id')) {
            $user_delete_id = $request->query('user_delete_id');
            $user_delete = User::getActiveUser($user_delete_id);
        }

        return Inertia::render('Admin/Users/Index', compact('users', 'user_delete'));
    }

    function create(Request $request) {
        return Inertia::render('Admin/Users/Create');
    }

    function store(UserAdminRequest $request) : RedirectResponse {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'zip_code' => $request->zip_code,
            'year_birth' => $request->year_birth,
            'picture' => $request->guardarFoto('picture', '/images', null),
            'email_verified_at' => Carbon::now()
        ]);

        return Redirect::route('admin.users.index');
    }

    function edit($id) {
        $user = User::findOrFail($id);

        return Inertia::render('Admin/Users/Edit', compact('user'));
    }

    function update(UserAdminRequest $request, $id) : RedirectResponse {
        $user = User::findOrFail($id);
        $picture = $user->picture;
        $password = $user->password;

        $user->fill($request->validated());
        $user->picture = $request->guardarFoto('picture', '/images', $picture);

        if (Functions::hasValue($user->password) && $user->isDirty('password')) {
            $user->password = Hash::make($request->password);
        } else {
            $user->password = $password;
        }

        $user->save();

        return Redirect::route('admin.users.index');
    }

    function destroy(Request $request){
        $user = User::findOrFail($request->id);

        $user->email = null;
        $user->username = null;
        $user->email_verified_at = null;
        $user->password = null;
        $user->remember_token = null;
        $user->active = false;

        if($user->picture) {
            $path = storage_path('app/public') . str_replace('/storage','', $user->picture);
            if(is_file($path)) {
                unlink($path);
            }
        }

        $user->picture = null;
        $user->name = __('auth.anonymus');

        $user->save();
    }
}
