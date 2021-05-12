<?php

namespace App\Http\Livewire\User;

use App\Models\CountriesList;
use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public string $username = '';
    public string $email = '';
    public string $country = '';

    public array $countries = [];

    protected function rules()
    {
        return [
            'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users,username,' . auth()->id(),
            'email' => 'required|email:filter|unique:users,email,' . auth()->id(),
            'country' => 'required|max:2|regex:/^[A-Z]{2}$/',
        ];
    }

    public function mount()
    {
        if (auth()->guest()) {
            return back()->withErrors(['auth' => __('You must be logged in.')]);
        }

        /** @var User $user */
        $user = auth()->user();

        $this->username = $user->username;
        $this->email = $user->email;
        $this->country = $user->country;

        $this->countries = CountriesList::all($user->locale);
    }

    public function submit()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->update($this->validate());

        session()->flash('status', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);
    }

    public function updatedUsername()
    {
        $this->validateOnly('username');
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function updatedCountry()
    {
        $this->country = $this->country == 'undefined' ? '' : $this->country;

        $this->validateOnly('country');
    }

    public function saved()
    {
        session()->flash('status', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);
    }

    public function render()
    {
        return view('livewire.user.profile')
            ->layout('components.layouts.settings', [
                'title' => __('Profile'),
                'username' => auth()->user()->username,
            ]);
    }
}
