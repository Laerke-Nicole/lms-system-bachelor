<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
//    mark a notification as read
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }
}
