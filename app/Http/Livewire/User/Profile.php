<?php

namespace App\Http\Livewire\User;

use App\Models\CountriesList;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $username = '';
    public string $email = '';
    public string $country = '';
    public $avatar;

    public bool $hasAvatar = false;
    public string $avatarPath = '';

    public array $countries = [];

    protected function rules()
    {
        return [
            'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users,username,' . auth()->id(),
            'email' => 'required|email:filter|unique:users,email,' . auth()->id(),
            'country' => 'required|max:2|regex:/^[A-Z]{2}$/',
            'avatar' => 'nullable|image|max:2048',
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
        $this->hasAvatar = $user->hasAvatar();
        $this->avatarPath = Storage::url($user->avatar);

        $this->countries = CountriesList::all($user->locale);
    }

    public function submit()
    {
        /** @var User $user */
        $user = auth()->user();

        $formData = $this->validate();

        if ($this->avatar) {
            $filePath = $this->avatar->store('avatars', 'public');
            $formData['avatar'] = $filePath;
            $this->hasAvatar = true;
            $this->avatarPath = $filePath;
            $user->removeAvatarFile(); // remove previous
        } else {
            unset($formData['avatar']); // prevent to remove old avatar when the new one is not set
        }

        $user->update($formData);

        $this->emitTo('user.avatar', 'avatarChanged');

        session()->flash('status', [
            'type' => 'success',
            'message' => __('Saved.'),
        ]);
    }

    public function removeAvatar()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->removeAvatarFile();
        $user->update([
            'avatar' => null,
        ]);

        $this->avatarPath = '';
        $this->hasAvatar = false;
        $this->avatar = null;

        $this->emitTo('user.avatar', 'avatarChanged');

        session()->flash('status', [
            'type' => 'success',
            'message' => __('Removed.'),
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

    public function render()
    {
        return view('livewire.user.profile')
            ->layout('components.layouts.settings', [
                'title' => __('Profile'),
                'username' => auth()->user()->username,
            ]);
    }
}
