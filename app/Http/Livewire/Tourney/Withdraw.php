<?php

namespace App\Http\Livewire\Tourney;

use Livewire\Component;

class Withdraw extends Component
{
    public bool $showDialog = false;
    public $tourney;

    public function handle()
    {
        if (!auth()->check()) {
            session()->flash('flash', [
                'type' => 'warning',
                'message' => __('You must log in the site.'),
            ]);

            return redirect()->route('tourneys.index');
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->isSignedForTourney($this->tourney)) {
            session()->flash('flash', [
                'type' => 'warning',
                'message' => __('You have not signed for the tourney.'),
            ]);

            return redirect()->route('tourneys.index');
        }


        try {
            $user->withdrawTourney($this->tourney);

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('You have been withdrawn from the tourney.'),
            ]);
        } catch (\DomainException $e) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return redirect()->route('tourneys.index');
    }

    public function render()
    {
        return view('livewire.tourney.withdraw', [
            'buttonCaption' => __('Withdraw'),
            'confirmationMessage' => __('You are going to withdraw from the tourney. Proceed?'),
        ]);
    }
}
