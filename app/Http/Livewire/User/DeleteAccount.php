<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class DeleteAccount extends Component
{
    public string $email = '';
    public string $phrase = '';

    protected function rules()
    {
        return [
            'email' => ['required', 'email', 'in:' . auth()->user()->email],
            'phrase' => 'required|regex:/delete my account right now/',
        ];
    }

    protected function messages()
    {
        return [
            'email.in' => __('You must provide your email address.'),
            'phrase.regex' => __('You must exactly repeat the verify phrase.'),
        ];
    }

    public function submit()
    {
        $this->validate();

        /** @var User $user */
        $user = auth()->user();

        if ($user->isTeamCaptain()) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => __('You have to transfer captainship or delete your team first.'),
            ]);

            return redirect()->route('settings.account');
        }

        $user->removeAvatarFile();
        $user->delete();

        $this->dispatchBrowserEvent('modalSubmitted');

        session()->flash('flash', [
            'type' => 'info',
            'message' => __('Your account has been deleted. Bye now.'),
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.user.delete-account');
    }
}
