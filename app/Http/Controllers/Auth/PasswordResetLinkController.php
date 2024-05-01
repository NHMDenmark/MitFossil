<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSecurityQuestion;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'first' => 'required',
            'second' => 'required',
            'third' => 'required'
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['User not found'],
            ]);
        }
        $first = UserSecurityQuestion::where([['user_id', $user->id], ['question_number', 1]])->first();

        if ($first->answer != $request->first) {
            throw ValidationException::withMessages([
                'first' => ['Svaret er forkert'],
            ]);
        }

        $second = UserSecurityQuestion::where([['user_id', $user->id], ['question_number', 2]])->first();

        if ($second->answer != $request->second) {
            throw ValidationException::withMessages([
                'second' => ['Svaret er forkert'],
            ]);
        }

        $third = UserSecurityQuestion::where([['user_id', $user->id], ['question_number', 3]])->first();

        if ($third->answer != $request->third) {
            throw ValidationException::withMessages([
                'third' => ['Svaret er forkert'],
            ]);
        }
        DB::statement("DELETE FROM `password_reset_tokens` WHERE username = '$user->username'");
        $token = Str::random(20);
        PasswordResetToken::firstOrCreate([
            'username' => $user->username,
            'token' => Hash::make($token),
            'created_at' => now()
        ]);

        return redirect(route('password.reset', ['token' => $token]));
    }
}
