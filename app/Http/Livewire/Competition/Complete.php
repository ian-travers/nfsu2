<?php

namespace App\Http\Livewire\Competition;

use DomainException;
use Livewire\Component;

class Complete extends Component
{
    public bool $showDialog = false;
    public $competition;

    public function handle()
    {
        try {
            $this->competition->complete();

            session()->flash('flash', [
                'type' => 'success',
                'message' =>  __('Competition has been completed.'),
            ]);
        } catch (DomainException $e) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('adm.competitions.index');
    }

    public function render()
    {
        return view('livewire.tourney-handle.action', [
            'buttonCaption' => __('Complete'),
            'confirmationMessage' => __('Now the competition will be completed. Continue?'),
        ]);
    }
}
