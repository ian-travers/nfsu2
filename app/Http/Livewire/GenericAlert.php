<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenericAlert extends Component
{
    protected $listeners = ['passwordChanged', 'saved'];

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

    public function render()
    {
        return view('livewire.generic-alert');
    }
}
