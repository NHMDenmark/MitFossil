<?php

namespace App\Http\Controllers\Admin;

use App\Core\Functions;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAdminRequest;
use App\Models\User;
use App\Models\UserSecurityQuestion;
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
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => trim($request->role),
            'answered_questions' => true
        ]);

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    function edit($id) {
        $user = User::findOrFail($id);
        $userQuestions = UserSecurityQuestion::where('user_id', $user->id)->pluck('answer', 'question_number');

        return Inertia::render('Admin/Users/Edit', compact('user', 'userQuestions'));
    }

    function update(UserAdminRequest $request, $id) : RedirectResponse {
        $user = User::findOrFail($id);
        $password = $user->password;

        $user->fill($request->validated());

        if (Functions::hasValue($user->password) && $user->isDirty('password')) {
            $user->password = Hash::make($request->password);
        } else {
            $user->password = $password;
        }

        $user->save();

        return Redirect::to(session()->pull('previous_previous_url'));
    }

    function destroy(Request $request){
        $user = User::findOrFail($request->id);
        $user->username = null;
        $user->save();
        $user->delete();
    }
}
