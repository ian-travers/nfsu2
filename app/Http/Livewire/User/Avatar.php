<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Avatar extends Component
{
    public string $avatarPath = '';
    public bool $hasAvatar = false;

    protected $listeners = ['avatarChanged'];

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $this->hasAvatar = $user->hasAvatar();
        $this->avatarPath = Storage::url($user->avatar);
    }

    public function avatarChanged()
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.user.avatar');
    }
}
