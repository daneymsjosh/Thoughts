<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())->latest()->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->update(['is_read' => true]);

        $notificationData = json_decode($notification->data);
        switch ($notification->type) {
            case 'like':
            case 'unlike':
            case 'comment':
                return redirect()->route('thoughts.show', $notificationData->post_id);
            case 'follow':
            case 'unfollow':
                return redirect()->route('users.show', $notificationData->user_id);
            case 'message':
                return redirect()->route('conversations.show', $notification->conversation_id);
        }
    }
}
