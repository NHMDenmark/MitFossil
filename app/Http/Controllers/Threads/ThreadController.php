<?php

namespace App\Http\Controllers\Threads;

use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class ThreadController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $threads = Thread::with('sender', 'receiver', 'messages')->orderBy('updated_at', 'desc')->get();
        } else {
            $threads = Thread::with('sender', 'receiver', 'messages')->where('receiver_id', $user->id)->orWhere('sender_id', $user->id)->orderBy('updated_at', 'desc')->get();
        }

        return Inertia::render('Threads/List', compact('threads', 'user'));
    }

    public function create()
    {
        $categories = Thread::CATEGORIES;

        $user = Auth::user();

        $receivers = User::whereIn('role', ['customer', 'curator'])
            ->whereNotNull('username')
            ->get()
            ->map(function ($item, $key) {
                return [
                    'value' => $item->id,
                    'label' => $item->username
                ];
            });

        return Inertia::render('Threads/Create', compact('categories', 'receivers', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'status' => ['required', 'string', 'in:open,closed'],
            'category' => ['required', 'string'],
            'text' => ['required', 'string']
        ]);

        $user = Auth::user();

        if($request->input('all_users')){
            $receivers = User::where('role', '!=', 'admin')->whereNotNull('username')->get();
            foreach ($receivers as $receiver) {
                $this->sendThread($receiver->id, $user, $request);
            }
            return redirect(route('threads.index'));
        } else {
            if($user->role == 'admin') {
                $receiverID = $request->receiver_id;
            } else {
                $receiverID = User::where('role', 'admin')->first()->id;
            }
            $thread = $this->sendThread($receiverID, $user, $request);
            return redirect(route('threads.get', ['thread' => $thread->id]));
        }



    }

    private function sendThread(int $receiverID, $user, Request $request)
    {
        $thread = Thread::create([
            'receiver_id' => $receiverID,
            'sender_id' => $user->id,
            'title' => $request->title,
            'status' => $request->status,
            'category' => $request->category
        ]);

        $message = Message::create([
            'sender_id' => $user->id,
            'body' => $request->text,
            'thread_id' => $thread->id
        ]);

        if (count($request->attachments) > 0) {
            foreach ($request->attachments as $attachment) {
                $filenameWithExt = $attachment->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $attachment->storeAs('attachments', $fileNameToStore);

                MessageAttachment::create([
                    'message_id' => $message->id,
                    'name' => $fileNameToStore,
                    'path' => $path
                ]);
            }
        }

        if($user->role == 'admin') {
            Notification::create([
                'user_id' => $receiverID,
                'user_notificator_id' => $user->id,
                'type' => 'new-message',
                'fossil_id' => $thread->id,
                'title' => 'Ny besked',
                'text' => 'Du har modtaget en ny besked.'
            ]);
        } else {
            foreach (User::where('role', 'admin')->get() as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'user_notificator_id' => $user->id,
                    'type' => 'new-message',
                    'fossil_id' => $thread->id,
                    'title' => 'Ny besked',
                    'text' => 'Du har modtaget en ny besked.'
                ]);
            }
        }

        return $thread;
    }

    public function changeStatus(Thread $thread, $status)
    {
        $user = Auth::user();
        $sender = $thread->sender;
        $receiver = $thread->receiver;

        if ($user->role != 'admin') {
            return redirect(route('threads.index'));
        }

        $thread->status = $status;
        if ($status == 'closed') {
            $thread->closed_at = now();
        } elseif ($status == 'open') {
            $thread->closed_at = null;
        }

        $thread->save();

        return Inertia::location(route('threads.get', ['thread' => $thread->id]));
    }

    public function deleteMessage(Thread $thread, Message $message)
    {
        $user = Auth::user();

        if ($user->role != 'admin') {
            return redirect(route('threads.get', ['thread' => $message->thread->id]));
        }

        $message->delete();

        if (count($thread->messages) == 0) {
            $thread->delete();

            return Inertia::location(route('threads.index'));
        }

        return Inertia::location(route('threads.get', ['thread' => $message->thread->id]));
    }

    public function get(Thread $thread)
    {
        Auth::user()->sendEmailVerificationNotification();
        $user = Auth::user();
        $thread = Thread::with('messages', 'sender', 'receiver', 'messages.sender', 'messages.attachments', 'messages.thread')->find($thread->id);
        $messages = $thread->messages;
        $sender = $thread->sender;
        $receiver = $thread->receiver;

        if ($user->role != 'admin' && $user->id != $sender->id && $user->id != $receiver->id) {
            return redirect(route('threads.index'));
        }

        return Inertia::render('Threads/Thread', compact('messages', 'sender', 'receiver', 'thread', 'user'));
    }

    public function delete(Thread $thread)
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $thread = Thread::find($thread->id);
            $thread->messages()->delete();
            $thread->delete();
        }

        return redirect(route('threads.index'));
    }

    public function storeMessage(Request $request, Thread $thread)
    {
        $request->validate([
            'text' => ['required', 'string']
        ]);

        $user = Auth::user();
        $sender = $thread->sender;
        $receiver = $thread->receiver;

        if ($thread->status == 'closed') {
            return redirect(route('threads.get', ['thread' => $thread->id]));
        }

        if ($user->role != 'admin' && $user->id != $sender->id && $user->id != $receiver->id) {
            return redirect(route('threads.index'));
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'body' => $request->text,
            'thread_id' => $thread->id
        ]);

        if (count($request->attachments) > 0) {
            foreach ($request->attachments as $attachment) {
                $filenameWithExt = $attachment->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $attachment->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $attachment->storeAs('attachments', $fileNameToStore);

                MessageAttachment::create([
                    'message_id' => $message->id,
                    'name' => $fileNameToStore,
                    'path' => $path
                ]);
            }
        }

        if($user->role == 'admin') {
            $receiverID = $thread->receiver_id;
            $notificationUser = User::find($receiverID);
            if($notificationUser->role == 'admin') {
                $receiverID = $thread->sender_id;
            }
            Notification::create([
                'user_id' => $receiverID,
                'user_notificator_id' => Auth::id(),
                'type' => 'new-message',
                'fossil_id' => $thread->id,
                'title' => 'Ny besked',
                'text' => 'Du har modtaget en ny besked.'
            ]);
        } else {
            foreach (User::where('role', 'admin')->get() as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'user_notificator_id' => $user->id,
                    'type' => 'new-message',
                    'fossil_id' => $thread->id,
                    'title' => 'Ny besked',
                    'text' => 'Du har modtaget en ny besked.'
                ]);
            }
        }

        return Inertia::location(route('threads.get', ['thread' => $thread->id]));
    }

    public function getAttachment($name)
    {
        $user = Auth::user();

        $attachment = MessageAttachment::where('name', $name)->first();
        $sender = $attachment->message->thread->sender;
        $receiver = $attachment->message->thread->receiver;

        if ($user->role != 'admin' && $user->id != $sender->id && $user->id != $receiver->id) {
            abort(403);
        }

        return response()->download(storage_path('app/' . $attachment->path));
    }
}
