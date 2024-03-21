<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CopyrightRule;
use App\Models\Fossil;
use App\Models\FossilRegion;
use App\Models\FossilSpeciality;
use App\Models\Licence;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

        return Inertia::render('Customer/Profile/Edit', [
            'myCollections' => $myCollections,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'copyright_rules' => $copyright_rules,
            'fossil' => $fossil,
            'origin' => $origin
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $images = $request->guardarFoto('picture', '/images', $request->user()->picture);

        if(is_array($images)) {
            $request->user()->picture = $images[0];
        }

        if($request->picture == 'empty') {
            $request->user()->picture = null;
        }
        
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
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
}
