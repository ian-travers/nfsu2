<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;

class EditTeamController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->isTeamCaptain()) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'error',
                'message' => 'Insufficient rights to edit the team.'
            ]);
        }

        return view('frontend.user.team.edit', [
            'user' => $user,
            'title' => __('Edit team'),
            'team' => Team::findOrFail($user->team_id),
        ]);
    }

    public function update()
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->isTeamCaptain()) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'error',
                'message' => 'Insufficient rights to edit the team.'
            ]);
        }

        $data = $this->validate(request(), [
            'clan' => 'required|string|min:2|max:12',
            'name' => 'required|string|min:6|max:60',
            'password' => 'required|string|min:4|max:16',
        ]);

        $team = Team::findOrFail($user->team_id);
        $team->update($data);

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => 'Saved.',
        ]);
    }
}
