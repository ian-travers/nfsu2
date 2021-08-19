<?php

namespace App\Http\Livewire\TourneyHandle;

use DomainException;
use Livewire\Component;

class Complete extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        try {
            $this->tourney->complete();

            session()->flash('flash', [
                'type' => 'success',
                'message' =>  __('Tourney has been completed.'),
            ]);
        } catch (DomainException $e) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('cabinet.tourneys.handle.index', $this->tourney);
    }

    public function render()
    {
        return view('livewire.tourney-handle.complete');
    }
}
