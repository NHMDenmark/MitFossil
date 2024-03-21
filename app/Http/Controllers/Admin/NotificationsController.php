<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function index(Request $request) {
        $notifications = Notification::getNotifications( $request->user()->id );

        return Inertia::render('Admin/Notification/Index', [
            'notifications' => $notifications,
        ]);
    }

    public function update($id) {
        $notification = Notification::findOrFail($id);
        $notification->viewed = true;

        $notification->save();

        if($notification->fossil_id !== null) {
            return to_route('customer.dashboard', ['fossil' => $notification->fossil_id]);
        } else {
            if($notification->type === 'delete-curator') {
                return to_route('admin.users.index', ['user_delete_id' => $notification->user_notificator_id]);
            }
            if($notification->type === 'delete-user') {
                return to_route('admin.customer.index', ['user_delete_id' => $notification->user_notificator_id]);
            }
            return to_route('admin.notifications');
        }
    }
}
