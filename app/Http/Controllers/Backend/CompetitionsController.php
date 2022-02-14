<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Competition\Competition;
use App\Models\NFSUServer\SpecificGameData;
use App\Settings\SeasonSettings;

class CompetitionsController extends Controller
{
    public function index()
    {
        return view('backend.competitions.index', [
            'title' => __('Competitions'),
            'competitions' => Competition::latest('ended_at')->paginate(10),
        ]);
    }

    public function create()
    {
        session()->put('url.intended', url()->previous() == url()->current() ? route('adm.competitions.index') : url()->previous());

        if ($this->checkSuspending()) {
            return redirect()->route('adm.competitions.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        return view('backend.competitions.create', [
            'title' => __('Create new competition'),
            'competition' => new Competition([
                'started_at' => now()->today(),
                'ended_at' => now()->addDays(7)
            ]),
            'circuits' => SpecificGameData::allCircuits(),
            'sprints' => SpecificGameData::allSprints(),
            'drags' => SpecificGameData::allDrags(),
            'drifts' => SpecificGameData::allDrifts(),
        ]);
    }

    public function store()
    {
        Competition::create(array_merge([
            'season_index' => app(SeasonSettings::class)->index,
        ], $this->validateForm()));

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('Competition has been created.'),
        ]);
    }

    public function edit(Competition $competition)
    {
        if ($this->checkSuspending()) {
            return redirect()->route('adm.competitions.index')->with('flash', [
                'type' => 'warning',
                'message' => __('Season is suspended.'),
            ]);
        }

        session()->put('url.intended', url()->previous() == url()->current() ? route('adm.competitions.index') : url()->previous());

        return view('backend.competitions.edit', [
            'title' => __('Edit competition'),
            'competition' => $competition,
            'circuits' => SpecificGameData::allCircuits(),
            'sprints' => SpecificGameData::allSprints(),
            'drags' => SpecificGameData::allDrags(),
            'drifts' => SpecificGameData::allDrifts(),
        ]);
    }

    public function update(Competition $competition)
    {
        $competition->update($this->validateForm());

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('Competition has been updated.'),
        ]);
    }

    public function remove(Competition $competition)
    {
        $competition->delete();

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Competition has been deleted.'),
        ]);
    }

    protected function validateForm()
    {
        return request()->validate([
            'is_completed' => 'nullable|boolean',
            'track1_id' => 'required|string',
            'track2_id' => 'nullable|string',
            'track3_id' => 'nullable|string',
            'track4_id' => 'nullable|string',
            'started_at' => 'required|date',
            'ended_at' => 'required|date',
        ]);
    }

    protected function checkSuspending(): bool
    {
        return app(SeasonSettings::class)->suspend;
    }
}
