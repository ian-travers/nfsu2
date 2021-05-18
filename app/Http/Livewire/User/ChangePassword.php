<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class ChangePassword extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    protected array $rules = [
        'password' => 'required|min:8|confirmed|regex:/^\S*$/u',
    ];

    public function submit()
    {
        $this->validate();

        /** @var User $user */
        $user = auth()->user();

        $user->forceFill(['password' => bcrypt($this->password)])->save();

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Your password has been changed.'),
        ]);

        return redirect()->route('settings.account');
    }

    public function render()
    {
        return view('livewire.user.change-password');
    }
}
