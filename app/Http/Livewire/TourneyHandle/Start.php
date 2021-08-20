<?php

namespace App\Http\Livewire\TourneyHandle;

use DomainException;
use Livewire\Component;

class Start extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        try {
            $this->tourney->start();

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('Tourney has been started. You may wait for a couple of minutes and announce the first round.'),
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
            'buttonCaption' => __('Approve the draw and start the tourney'),
            'confirmationMessage' => __('Now the heats will be available for viewing on the tourney page. Continue?'),
        ]);
    }
}
