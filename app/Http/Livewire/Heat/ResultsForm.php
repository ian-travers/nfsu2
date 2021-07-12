<?php

namespace App\Http\Livewire\Heat;

use App\Models\Tourney\Heat;
use App\Models\Tourney\HeatRacer;
use App\Settings\ScoringSettings;
use Livewire\Component;

class ResultsForm extends Component
{
    public Heat $heat;
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
        $this->heat = $heat;

        foreach ($heat->racers as $index => $racer) {
            $this->resultsForm[$index]['id'] = $racer->id;
            $this->resultsForm[$index]['place'] = $racer->place;
        }

        $this->racers = $heat->racers->toArray();
    }

    public function submit()
    {
        $formData = $this->validate();


        array_map(function ($item) {
            $raceResult = HeatRacer::findOrFail($item['id']);

            switch ($item['place']) {
                case 1:
                    $pts = $raceResult->heat->isFinal()
                        ? app(ScoringSettings::class)->tourney_final_first
                        : app(ScoringSettings::class)->tourney_regular_first;
                    break;
                case 2:
                    $pts = $raceResult->heat->isFinal()
                        ? app(ScoringSettings::class)->tourney_final_second
                        : app(ScoringSettings::class)->tourney_regular_second;
                    break;
                case 3:
                    $pts = $raceResult->heat->isFinal()
                        ? app(ScoringSettings::class)->tourney_final_third
                        : app(ScoringSettings::class)->tourney_regular_third;
                    break;
                case 4:
                    $pts = $raceResult->heat->isFinal()
                        ? app(ScoringSettings::class)->tourney_final_fourth
                        : app(ScoringSettings::class)->tourney_regular_fourth;
                    break;
                default:
                    $pts = 0;
            }

            $raceResult->update([
                'place' => $item['place'],
                'pts' => $pts,

            ]);
        }, $formData['resultsForm']);

        $this->dispatchBrowserEvent('modalSubmitted');

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);

        return redirect()->route('cabinet.tourneys.handle.index', $this->heat->tourney_id);
    }

    public function render()
    {
        return view('livewire.heat.results-form', [
            'racers' => $this->racers,
        ]);
    }
}
