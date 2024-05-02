<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function index(Request $request) {
        $notifications = Notification::getNotifications($request->user()->id);

        return Inertia::render('Customer/Notification/Index', [
            'notifications' => $notifications,
        ]);
    }

    public function update($id) {
        $notification = Notification::findOrFail($id);
        $notification->viewed = true;

        $notification->save();

        if($notification->fossil_id !== null) {
            if($notification->type == 'new-message') {
                return to_route('threads.get', ['thread' => $notification->fossil_id]);
            }
            return to_route('customer.dashboard', ['fossil' => $notification->fossil_id]);
        } else {
            return to_route('customer.notifications');
        }
    }
}
