<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function index()
    {
        return  view('frontend.players-list', [
            'players' =>  User::orderByDesc('site_points')->paginate(30),
            'title' => __('Players list'),
        ]);
    }

    public function show(User $user)
    {
        return view('frontend.public-profile', [
            'user' => $user,
            'title' => __('Public profile'),
        ]);
    }
}
