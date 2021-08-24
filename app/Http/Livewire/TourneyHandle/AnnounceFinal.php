<?php

namespace App\Http\Livewire\TourneyHandle;

use DomainException;
use Livewire\Component;

class AnnounceFinal extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        try {
            $this->tourney->final();

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('The final round may be started. You may wait for a minute and announce the final round.'),
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
        return view('livewire.confirm-action', [
            'buttonCaption' => __('Announce the final round'),
            'confirmationMessage' => __('Now the final heat racers will be available for viewing on the tourney page. Continue?'),
        ]);
    }
}
