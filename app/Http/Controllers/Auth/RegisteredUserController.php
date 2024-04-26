<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ImageRequest $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:32|unique:'.User::class,
            'email' => ['required', 'email'],
            'copyright_rule_id' => 'required',
        ]);

        $otp = Str::random(20);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($otp),
            'copyright_rule_id' => $request->copyright_rule_id,
            'active' => true,
            'answered_questions' => false
        ]);

        event(new Registered($user));

        $text = 'Your OTP password to login to Mitfossil - ' . $otp;
        $admin_text = 'User with username ' . $request->username . ' was registered using email ' . $request->email;
        Mail::to($request->email)->send(new SendOTP(['body' => $text], 'One-Time Password'));
        Mail::to('mitfossil@snm.ku.dk')->send(new SendOTP(['body' => $admin_text], 'User-email relation'));

        return redirect(route('register.confirm'));
    }

    public function confirmPage(): Response
    {
        return Inertia::render('Auth/ConfirmRegister');
    }
}
