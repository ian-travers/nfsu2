<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamsController extends Controller
{
    public function show(Team $team)
    {
        return view('frontend.teams.show', [
            'team' => $team,
            'title' => __('View team'),
        ]);
    }
}
