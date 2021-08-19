<?php

namespace App\Http\Livewire\TourneyHandle;

use DomainException;
use Livewire\Component;

class Draw extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        try {
            $this->tourney->draw();

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('Random draw has been done.'),
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
        return view('livewire.tourney-handle.draw');
    }
}
