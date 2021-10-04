<?php

namespace App\Http\Livewire\Auth;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Register extends Component
{
    use WithRecaptcha;

    public string $username = '';
    public string $country = '';
    public string $email = '';
    public string $password = '';

    public array $countries;

    protected array $rules = [
        'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users',
        'country' => 'required|string|size:2|regex:/^[A-Z]+$/',
        'email' => 'required|email:filter|unique:users',
        'password' => 'required|min:8|regex:/^\S*$/u',
    ];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function submit()
    {
        $this->validate();

        /** @var User $user */
        $user = User::create([
            'username' => $this->username,
            'country' => $this->country,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        event(new Registered($user));

        auth()->login($user);

        session()->flash('status', [
            'type' => 'success',
            'message' => __('Your account has been created. Welcome to NFSU Cup.'),
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.front', [
                'title' => __('Register')
            ]);
    }
}
