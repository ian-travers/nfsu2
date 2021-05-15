<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function show()
    {
        return view('frontend.user.account', [
            'user' => auth()->user(),
            'title' => __('Account'),
        ]);
    }
}
