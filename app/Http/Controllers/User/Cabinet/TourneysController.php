<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Tourney\Tourney;
use Illuminate\Support\Facades\Gate;

class TourneysController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string|min:4|max:100',
            'track_id' => 'required|size:4',
            'room' => 'required|string|max:20',
            'started_at' => 'required|date|after:tomorrow',
            'signup_time' => 'required',
            'supervisor_id' => 'required',
            'supervisor_username' => 'required',
            'status' => 'required',
            'season_id' => 'required',
        ]);

        Tourney::create($attributes);

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => 'Tourney has been created.',
        ]);
    }

    public function update(Tourney $tourney)
    {
        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => 'Impossible to change someone else\'s tourney.',
            ]);
        }

        $attributes = request()->validate([
            'name' => 'required|string|min:4|max:100',
            'track_id' => 'required|size:4',
            'room' => 'required|string|max:20',
            'started_at' => 'required|date|after:tomorrow',
            'signup_time' => 'required',
        ]);

        $tourney->update($attributes);

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => 'Tourney has been updated.',
        ]);
    }

    public function remove(Tourney $tourney)
    {
        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => 'Impossible to delete someone else\'s tourney.',
            ]);
        }

        if(! $tourney->isDeletable()) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => 'You may only delete scheduled or cancelled tourneys.',
            ]);
        }

        $tourney->delete();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => 'Tourney has been deleted.',
        ]);
    }
}
