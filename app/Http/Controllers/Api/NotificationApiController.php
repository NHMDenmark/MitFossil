<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fossil;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function notify(Request $request) {
        if($request->user_curator_id !== $request->user()->id) {
            $notification = Notification::create([
                'type' => 'notify-curator',
                'user_id' => $request->user_curator_id,
                'user_notificator_id' => $request->user()->id,
                'fossil_id' => $request->fossil_id,
                'title' => __('notifications.notify_curator_title'),
                'text' => __('notifications.notify_curator_text'),
                'viewed' => false
            ]);
        }

        return response()->json(['ok' => true, 'notification' => $notification]);
    }

    public function report(Request $request) {
        $curators = User::getUserAdmin(false,true);

        $fossil = Fossil::find($request->fossil_id);

        $fossil->send_report = true;

        $fossil->save();

        $notificationType = $request -> report_option;

        if ($notificationType == 'okInappropiate'){
            $notification_title = __('notifications.report_curator_title_inappropriate');
            $notification_text = __('notifications.report_curator_text_inappropriate');

        } else if ($notificationType == 'okNotFossil') {
            $notification_title = __('notifications.report_curator_title_not_fossil');
            $notification_text = __('notifications.report_curator_text_not_fossil');
            
        } else if ($notificationType == 'okComment'){
            $notification_title = __('notifications.report_curator_title_comment');
            $notification_text = __('notifications.report_curator_text_comment');
        }

        foreach ($curators as $curator) {
            if($curator->id !== $request->user()->id) {
                $notification = Notification::create([
                    'type' => 'report-curator',
                    'user_id' => $curator->id,
                    'user_notificator_id' => $request->user()->id,
                    'fossil_id' => $fossil->id,
                    'title' => $notification_title,
                    'text' => $notification_text,
                    'viewed' => false
                ]);
            }
        }

        return response()->json(['ok' => true, 'notification' => $notification]);
    }

    public function deleted_fossil(Request $request) {
        if($request->user_id !== $request->user()->id) {
            $notification = Notification::create([
                'type' => 'deleted-fossil',
                'user_id' => $request->user_id,
                'user_notificator_id' => $request->user()->id,
                'fossil_id' => null,
                'title' => __('notifications.notify_curator_title'),
                'text' => __('notifications.notify_curator_text'),
                'viewed' => false
            ]);
        }

        return response()->json(['ok' => true, 'notification' => $notification]);
    }
}
