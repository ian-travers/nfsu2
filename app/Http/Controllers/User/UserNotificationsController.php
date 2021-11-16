<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserNotificationsController extends Controller
{
    public function index()
    {
        return view('frontend.user.notifications.index', [
            'title' => __('Your notifications'),
            'notifications' => auth()->user()->notifications()->paginate(20),
        ]);
    }

    public function remove(string $id)
    {
        auth()->user()->notifications()->findOrFail($id)->delete();

        return redirect()->route('notifications.index')->with('flash', [
            'type' => 'success',
            'message' => __('Notification has been deleted.'),
        ]);
    }

    public function toggleRead(string $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);

        $notification->read()
            ? $notification->markAsUnread()
            : $notification->markAsRead();

        return redirect()->route('notifications.index')->with('flash', [
            'type' => 'success',
            'message' => __('Notification read status has been updated.'),
        ]);
    }
}
