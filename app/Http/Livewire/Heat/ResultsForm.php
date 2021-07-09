<?php

namespace App\Http\Livewire\Heat;

use App\Models\Tourney\Heat;
use App\Models\Tourney\HeatParticipant;
use Livewire\Component;

class ResultsForm extends Component
{
    public string $tourneyId = '';
    public array $racers = [];
    public array $resultsForm = [];

    protected $listeners = ['heatProvided'];

    protected function rules()
    {
        return [
            'resultsForm.*.id' => 'required',
            'resultsForm.*.place' => 'required|integer|min:0|max:4',
        ];
    }
    public function heatProvided(Heat $heat)
    {
        $this->tourneyId = $heat->tourney_id;

        foreach ($heat->participants as $index => $racer) {
            $this->resultsForm[$index]['id'] = $racer->id;
            $this->resultsForm[$index]['place'] = $racer->place;
        }

        $this->racers = $heat->participants->toArray();
    }

    public function submit()
    {
        $formData = $this->validate();

        array_map(function ($item) {
            $raceResult = HeatParticipant::findOrFail($item['id']);
            $raceResult->update(['place' => $item['place']]);
        }, $formData['resultsForm']);

        $this->dispatchBrowserEvent('modalSubmitted');

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);

        return redirect()->route('cabinet.tourneys.handle.index', $this->tourneyId);
    }

    public function render()
    {
        return view('livewire.heat.results-form', [
            'racers' => $this->racers,
        ]);
    }
}
