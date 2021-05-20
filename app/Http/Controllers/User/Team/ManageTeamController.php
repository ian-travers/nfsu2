<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;

class ManageTeamController extends Controller
{
    public function index()
    {
        return view('frontend.user.team.index', [
            'user' => auth()->user(),
            'title' => __('Your team'),
        ]);
    }
}
