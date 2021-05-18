<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenericAlert extends Component
{
    protected $listeners = ['passwordChanged'];

    public function passwordChanged()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Password has been changed.'),
        ]);
    }

    public function render()
    {
        return view('livewire.generic-alert');
    }
}
