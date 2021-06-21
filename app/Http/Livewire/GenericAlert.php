<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenericAlert extends Component
{
    protected $listeners = ['passwordChanged', 'saved', 'seasonComplete', 'seasonSuspend', 'seasonResume'];

    public function passwordChanged()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Password has been changed.'),
        ]);
    }

    public function saved()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);
    }
}
