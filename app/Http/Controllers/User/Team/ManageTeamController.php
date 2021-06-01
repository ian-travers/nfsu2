<?php

namespace App\Http\Controllers\User\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use DomainException;

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

    public function removeMember(User $user)
    {
        $team = Team::find(auth()->user()->team_id);

        try {
            $team->removeMember($user);
        } catch (DomainException $e) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => 'Player has been removed from the team.',
        ]);
    }

    public function transferCaptainship(User $user)
    {
        $team = Team::find(auth()->user()->team_id);

        try {
            $team->transferCaptainship($user);
        } catch (DomainException $e) {
            return redirect()->route('settings.team.index')->with('flash', [
                'type' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('settings.team.index')->with('flash', [
            'type' => 'success',
            'message' => 'Captainship has been transferred.',
        ]);
    }
}
