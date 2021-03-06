<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;

class CreateTeamController extends Controller
{
    public function create()
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isTeamMember()) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'warning',
                'message' => __('You need to leave the current team.'),
            ]);
        }

        return view('frontend.user.team.create', [
            'user' => auth()->user(),
            'title' => __('Create team'),
            'team' => new Team(),
        ]);
    }

    public function store()
    {
        /** @var User $user */
        $user = auth()->user();

        $data = $this->validate(request(), [
            'clan' => 'required|string|min:2|max:12',
            'name' => 'required|string|min:6|max:60',
            'password' => 'required|string|min:4|max:16',
        ]);

        $user->createTeam($data);

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => __('Team has been created.')
        ]);
    }
}
