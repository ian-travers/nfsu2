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
}
