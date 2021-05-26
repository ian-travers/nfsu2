<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;

class JoinTeamController extends Controller
{
    public function join()
    {
        return view('frontend.user.team.join', [
            'user' => auth()->user(),
            'title' => __('Join team'),
            'teams' => Team::all(),
        ]);
    }

    public function store()
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isTeamMember()) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'error',
                'message' => 'You must leave the current team before joining a new one',
            ]);
        }

        $this->validate(request(), [
            'team_id' => 'required|exists:teams,id',
            'password' => 'required|string|min:4',
        ]);

        $team = Team::findOrFail(request('team_id'));

        if ($team->password !== request('password')) {
            return back()->with('flash', [
                'type' => 'error',
                'message' => __('Wrong team password.')
            ]);
        }

        $user->joinTeam($team);

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => __('You joined the team.')
        ]);
    }

    public function leave()
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->isTeamMember()) {
            $user->leaveTeam();

            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'success',
                'message' => 'You left the team.',
            ]);
        }
    }
}
