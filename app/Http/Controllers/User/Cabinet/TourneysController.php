<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\NFSUServer\SpecificGameData;
use App\Models\Tourney\Tourney;
use App\Settings\SeasonSettings;
use Illuminate\Support\Facades\Gate;

class TourneysController extends Controller
{
    public function index()
    {
        return view('frontend.user.cabinet.tourneys.index', [
            'tourneys' => auth()->user()->tourneys->paginate(10),
            'title' => __('Your tourneys'),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function create()
    {
        return view('frontend.user.cabinet.tourneys.create', [
            'tourney' => new Tourney(),
            'title' => __('Create tourney'),
            'circuits' => SpecificGameData::allCircuits(),
            'sprints' => SpecificGameData::allSprints(),
            'drags' => SpecificGameData::allDrags(),
            'drifts' => SpecificGameData::allDrifts(),
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string|min:4|max:100',
            'track_id' => 'required|size:5',
            'room' => 'required|string|max:20',
            'started_at' => 'required|date|after:tomorrow',
            'signup_time' => 'required',
            'description' => 'nullable',
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $attributes = array_merge([
            'supervisor_id' => $user->id,
            'supervisor_username' => $user->username,
            'status' => Tourney::STATUS_SCHEDULED,
            'season_id' => app(SeasonSettings::class)->index,
        ], $attributes);

        Tourney::create($attributes);

        return redirect()->route('cabinet.tourneys.index')->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been created.'),
        ]);
    }

    public function edit(Tourney $tourney)
    {
        return view('frontend.user.cabinet.tourneys.edit', [
            'tourney' => $tourney,
            'title' => __('Edit tourney'),
            'circuits' => SpecificGameData::allCircuits(),
            'sprints' => SpecificGameData::allSprints(),
            'drags' => SpecificGameData::allDrags(),
            'drifts' => SpecificGameData::allDrifts(),
        ]);
    }

    public function update(Tourney $tourney)
    {
        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's tourney."),
            ]);
        }

        $attributes = request()->validate([
            'name' => 'required|string|min:4|max:100',
            'track_id' => 'required|size:5',
            'room' => 'required|string|max:20',
            'started_at' => 'required|date|after:tomorrow',
            'signup_time' => 'required',
        ]);

        $tourney->update($attributes);

        return redirect()->route('cabinet.tourneys.index')->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been updated.'),
        ]);
    }

    public function remove(Tourney $tourney)
    {
        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to delete someone else's tourney."),
            ]);
        }

        if(! $tourney->isDeletable()) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => __('You may only delete scheduled or cancelled tourneys.'),
            ]);
        }

        $tourney->delete();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been deleted.'),
        ]);
    }
}
