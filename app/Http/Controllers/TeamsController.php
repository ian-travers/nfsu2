<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamsController extends Controller
{
    public function show(Team $team)
    {
        $team->load('racers.trophies');

        return view('frontend.teams.show', [
            'team' => $team,
            'title' => __('Team profile'),
        ]);
    }
}
