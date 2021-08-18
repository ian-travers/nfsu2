<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmDialog extends Component
{
    public bool $showDialog = false;

    public function handle()
    {
        dd('Dialog was confirmed!');
    }

    public function render()
    {
        return view('livewire.confirm-dialog');
    }
}
