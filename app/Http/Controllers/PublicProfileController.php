<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        return view('frontend.public-profile', [
            'user' => $user,
            'title' => __('Public profile'),
        ]);
    }
}
