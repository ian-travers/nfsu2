<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class NotificationsDropdown extends Component
{
    public $unreadNotifications;

    public function mount()
    {
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    public function markAsRead($id)
    {
        $notification = $this->unreadNotifications->find($id);
        $notification->markAsRead();

        return redirect()->to($notification->data['link']);
    }

    public function render()
    {
        return view('livewire.user.notifications-dropdown');
    }
}
