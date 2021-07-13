<?php

namespace App\Http\Livewire\Heat;

use App\Models\Tourney\Heat;
use App\Models\Tourney\TourneyRacer;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddRacerForm extends Component
{
    public Heat $heat;
    public array $allRacers = [];
    public string $userId = '';
    public array $finalists = [];

    protected $listeners = ['heatProvided'];

    protected array $messages = [
        'userId.not_in' => 'This racer is already added to the final.',
    ];

    protected function validationAttributes() {
        return [
            'userId' => __('racer'),
        ];
    }

    protected function rules()
    {
        return [
            'userId' => ['required', Rule::notIn($this->finalists)],
        ];
    }

    public function heatProvided(Heat $heat)
    {
        $this->heat = $heat;

        $this->allRacers = TourneyRacer::where('tourney_id', $this->heat->tourney_id)->pluck('racer_username', 'user_id')->toArray();

        $heat->racers->map(function ($racer) {
            $this->finalists[] = $racer->user_id;
        });
    }

    public function submit()
    {
        $formData = $this->validate();

        if (count($this->finalists) >= 4) {
            session()->flash('flash', [
                'type' => 'warning',
                'message' => __('There can be up to four racers in the final round.'),
            ]);

            return redirect()->route('cabinet.tourneys.handle.index', $this->heat->tourney_id);
        }

        $this->finalists[] = $formData['userId'];

        $this->heat->racers()->create([
            'user_id' => $formData['userId'],
            'racer_username' => $this->allRacers[$formData['userId']],
            'order' => count($this->finalists),
        ]);

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Racer has been added to the final.'),
        ]);

        return redirect()->route('cabinet.tourneys.handle.index', $this->heat->tourney_id);
    }

    public function clearAll()
    {
        $this->finalists = [];

        $this->heat->racers->map(function (Heat $racer) {
            $racer->delete();
        });
    }

    public function render()
    {
        return view('livewire.heat.add-racer-form', [
            'racers' => $this->allRacers,

            'finalists' => $this->finalists,
        ]);
    }
}
