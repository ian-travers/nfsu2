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

    public function seasonComplete()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Season has been completed. New season starts.'),
        ]);
    }

    public function seasonSuspend()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Season has been suspended.'),
        ]);
    }

    public function seasonResume()
    {
        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Season has been resumed.'),
        ]);
    }

    public function render()
    {
        return view('livewire.generic-alert');
    }
}
