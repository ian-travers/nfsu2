<?php

namespace App\Http\Livewire\Tourney;

use Livewire\Component;

class Signup extends Component
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

        if ($user->isSignedForTourney($this->tourney)) {
            session()->flash('flash', [
                'type' => 'warning',
                'message' => __('You may sign up only once.'),
            ]);

            return redirect()->route('tourneys.index');
        }

        try {
            $user->signupTourney($this->tourney);

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('You have been signed up the tourney.'),
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
        return view('livewire.tourney.signup', [
            'buttonCaption' => __('Sign Up'),
            'confirmationMessage' => __('You are going to sign up in the tourney. You can withdraw before the tourney starts. Proceed?'),
        ]);
    }
}
