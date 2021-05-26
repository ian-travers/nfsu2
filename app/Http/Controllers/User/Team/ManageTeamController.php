<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;

class ManageTeamController extends Controller
{
    public function index()
    {
        return view('frontend.user.team.index', [
            'user' => auth()->user(),
            'title' => __('Your team'),
            'team' => Team::find(auth()->user()->team_id),
        ]);
    }
}
