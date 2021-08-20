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
                'message' => __("Random draw has been done. If something doesn't suit you, you can do it again."),
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
        return view('livewire.tourney-handle.action', [
            'buttonCaption' => __('Random draw'),
            'confirmationMessage' => __('Now the heats for the tourney will be created and the drawing for the racers will be held. Continue?'),
        ]);
    }
}
