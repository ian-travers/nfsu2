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
        return view('livewire.confirm-action', [
            'buttonCaption' => __('Complete the tourney'),
            'confirmationMessage' => __('Now the tourney will be completed. Check carefully all the results of the races. The completing of the tourney is done once and cannot be cancelled. Continue?'),
        ]);
    }
}
