<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\User;

class CreateTeamController extends Controller
{
    public function create()
    {
        return view('frontend.user.team.create', [
            'user' => auth()->user(),
            'title' => __('Create team'),
        ]);
    }

    public function store()
    {
        /** @var User $user */
        $user = auth()->user();

        request()['captain_id'] = $user->id;

        $data = $this->validate(request(), [
            'clan' => 'required|string|min:2|max:12',
            'name' => 'required|string|min:6|max:60',
            'password' => 'required|string|min:4|max:16',
            'captain_id' => 'required|integer',
        ]);

        $user->createTeam($data);

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => __('Team has been created.')
        ]);
    }
}
