<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\QuestionsUpdateRequest;
use App\Providers\RouteServiceProvider;
use App\Models\CopyrightRule;
use App\Models\Fossil;
use App\Models\FossilRegion;
use App\Models\FossilSpeciality;
use App\Models\Licence;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserSecurityQuestion;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $copyright_rules = CopyrightRule::getDropdown();
        $myCollections = Fossil::getCollection($request->user()->id, 3, 'my-collection');
        $origin = 'profile';

        $fossil = null;
        if($request->user() !== null && $request->query('fossil')) {
            $fossil_id = $request->query('fossil');
            $fossil = Fossil::getFossil($fossil_id);
        }

        $userQuestions = UserSecurityQuestion::where('user_id', $request->user()->id)->pluck('answer', 'question_number');

        return Inertia::render('Customer/Profile/Edit', [
            'myCollections' => $myCollections,
            'status' => session('status'),
            'copyright_rules' => $copyright_rules,
            'fossil' => $fossil,
            'origin' => $origin,
            'userQuestions' => $userQuestions
        ]);
    }

    public function questions(Request $request)
    {
        return Inertia::render('Customer/Profile/Questions');
    }

    public function saveQuestions(Request $request)
    {
        $request->validate([
            'first' => ['required', 'string'],
            'second' => ['required', 'string'],
            'third' => ['required', 'string'],
            'password' => ['required', Password::defaults(), 'confirmed']
        ]);

        UserSecurityQuestion::create([
            'user_id' => $request->user['id'],
            'question_number' => 1,
            'answer' => $request->first,
        ]);

        UserSecurityQuestion::create([
            'user_id' => $request->user['id'],
            'question_number' => 2,
            'answer' => $request->second,
        ]);

        UserSecurityQuestion::create([
            'user_id' => $request->user['id'],
            'question_number' => 3,
            'answer' => $request->third,
        ]);

        $user = Auth::user();
        $user->answered_questions = true;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('customer.profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        $user->send_delete = true;
        $user->save();

        $text = str_replace('{{user_name}}', $user->username, __('notifications.user_send_delete_text'));

        $admins = User::getUserAdmin(false, true);

        foreach ($admins as $admin) {
            if($admin->id !== $request->user()->id) {
                Notification::create([
                    'type' => $user->role === 'curator' ? 'delete-curator' : 'delete-user',
                    'user_id' => $admin->id,
                    'user_notificator_id' => $user->id,
                    'title' => __('notifications.user_send_delete_title'),
                    'text' => $text,
                    'viewed' => false
                ]);
            }
        }

        return Redirect::route('customer.profile.edit');
    }

    public function updateQuestions(QuestionsUpdateRequest $request)
    {
        $user = $request->user();
        $answers = [
            1 => $request->input('first'),
            2 => $request->input('second'),
            3 => $request->input('third'),
        ];

        foreach ($answers as $number => $answer) {
            UserSecurityQuestion::updateOrCreate([
                'user_id' => $user->id,
                'question_number' => $number
            ], [
                'answer' => $answer
            ]);
        }

        return Redirect::route('customer.profile.edit');
    }
}
