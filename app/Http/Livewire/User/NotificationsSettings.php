<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class NotificationsSettings extends Component
{
    public bool $is_browser_notified = false;
    public bool $is_email_notified = false;

    protected function rules()
    {
        return [
            'is_browser_notified' => 'required|boolean',
            'is_email_notified' => 'required|boolean',
        ];
    }
    public function mount()
    {
        if (auth()->guest()) {
            return back()->withErrors(['auth' => __('You must be logged in.')]);
        }

        /** @var User $user */
        $user = auth()->user();

        $this->is_browser_notified = $user->browserNotified();
        $this->is_email_notified = $user->emailNotified();
    }

    public function toggleBrowser()
    {
        $this->is_browser_notified = !$this->is_browser_notified;
    }

    public function toggleEmail()
    {
        $this->is_email_notified = !$this->is_email_notified;
    }

    public function submit()
    {
        /** @var User $user */
        $user = auth()->user();

        $formData = $this->validate();

        $user->update($formData);

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);

        return redirect()->route('settings.notifications');
    }

    public function render()
    {
        return view('livewire.user.notifications-settings')
            ->layout('components.layouts.settings', [
                'title' => __('Notifications'),
                'username' => auth()->user()->username,
            ]);
    }
}
