<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Login extends Component
{
    use WithRecaptcha;

    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public string $message = '';

    protected array $rules = [
        'email' => 'required|email:filter',
        'password' => 'required|min:8',
    ];

    public function toggleRemember()
    {
        $this->remember = !$this->remember;
    }

    public function submit()
    {
        $credentials = $this->validate();

        if (auth()->attempt($credentials, $this->remember)) {
            session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $this->message = __('These credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.front', [
                'title' => __('Login')
            ]);
    }
}
