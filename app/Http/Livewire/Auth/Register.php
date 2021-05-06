<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public string $username = '';
    public string $email = '';
    public string $password = '';

    protected array $rules = [
        'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users',
        'email' => 'required|email:filter|unique:users',
        'password' => 'required|min:8|regex:/^\S*$/u',
    ];

    public function submit()
    {
        $this->validate();

        /** @var User $user */
        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        auth()->login($user);

        session()->flash('status', [
            'type' => 'success',
            'message' => __('Your account has been created. Welcome to NFSU Cup.'),
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'locale' => app()->getLocale(),
        ])
            ->layout('components.layouts.front', [
                'title' => __('Register')
            ]);
    }
}
