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
            'tourneys' => auth()->user()->tourneys()->latest('started_at')->paginate(10),
            'suspend' => app(SeasonSettings::class)->suspend,
            'title' => __('Your tourneys'),
        ]);
    }

    public function create()
    {
        if ($this->checkSuspending()) {
            return redirect()->route('cabinet.tourneys.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        session()->put('url.intended', url()->previous() == url()->current() ? route('cabinet.tourneys.index') : url()->previous());

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
        if ($this->checkSuspending()) {
            return redirect()->route('cabinet.tourneys.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

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
            'season_index' => app(SeasonSettings::class)->index,
        ], $attributes);

        Tourney::create($attributes);

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been created.'),
        ]);
    }

    public function edit(Tourney $tourney)
    {
        if ($this->checkSuspending()) {
            return redirect()->route('cabinet.tourneys.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's tourney."),
            ]);
        }

        if (!$tourney->isScheduled()) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => __('Impossible to edit tourney with this status.'),
            ]);
        }

        session()->put('url.intended', url()->previous() == url()->current() ? route('cabinet.tourneys.index') : url()->previous());

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
        if ($this->checkSuspending()) {
            return redirect()->route('cabinet.tourneys.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's tourney."),
            ]);
        }

        if (!$tourney->isScheduled()) {
            return redirect()->route('cabinet.tourneys.index', $tourney)->with('flash', [
                'type' => 'warning',
                'message' => __('Impossible to edit tourney with this status.'),
            ]);
        }

        $attributes = request()->validate([
            'name' => 'required|string|min:4|max:100',
            'track_id' => 'required|size:5',
            'room' => 'required|string|max:20',
            'started_at' => 'required|date|after:tomorrow',
            'signup_time' => 'required',
            'description' => 'nullable',
        ]);

        $tourney->update($attributes);

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been updated.'),
        ]);
    }

    public function remove(Tourney $tourney)
    {
        if ($this->checkSuspending()) {
            return redirect()->route('cabinet.tourneys.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        if (Gate::denies('update-tourney', $tourney)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to delete someone else's tourney."),
            ]);
        }

        if (!$tourney->isEditable()) {
            return redirect()->back()->with('flash', [
                'type' => 'warning',
                'message' => __('You may only delete scheduled or cancelled tourneys.'),
            ]);
        }

        $tourney->delete();

        return redirect()->route('cabinet.tourneys.index')->with('flash', [
            'type' => 'success',
            'message' => __('Tourney has been deleted.'),
        ]);
    }

    protected function checkSuspending(): bool
    {
        return app(SeasonSettings::class)->suspend;
    }
}
