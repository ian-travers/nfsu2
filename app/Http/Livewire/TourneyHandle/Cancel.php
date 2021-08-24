<?php

namespace App\Http\Livewire\TourneyHandle;

use DomainException;
use Livewire\Component;

class Cancel extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        try {
            $this->tourney->cancel();

            session()->flash('flash', [
                'type' => 'success',
                'message' =>  __('Tourney has been cancelled.'),
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
            'buttonCaption' => __('Cancel the tourney'),
            'confirmationMessage' => __('Now the tourney will be cancelled. Continue?'),
        ]);
    }
}
