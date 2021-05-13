<div class="bg-white rounded-md sm:rounded-lg text-gray-900 px-4 py-2 sm:py-6 mx-4">
    @if ($alert = session('status'))
        <x-alerts.flash type="{{ $alert['type'] }}">{{ $alert['message'] }}</x-alerts.flash>
    @endif
    <div class="grid grid-cols-3 gap-x-4">
        <div class="space-y-4 col-span-2">
            <div class="">
                <x-form.label for="username" value="{{ __('Username') }}"/>
                <x-form.input
                    wire:model.lazy="username"
                    class="block w-full mt-1"
                    type="text"
                    name="username"
                    maxlength="15"
                    :value="old('username')"
                    autofocus required
                    autocomplete="username"
                />
                @error('username')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>

            <div class="">
                <x-form.label for="email" value="Email"/>
                <x-form.input
                    wire:model.lazy="email"
                    class="block w-full mt-1"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="email"
                />
                @error('email')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>

            <div class="">
                <x-form.label for="country" value="{{ __('Country') }}"/>
                <x-form.country-selector :countries="$countries"/>
                @error('country')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>
        {{-- Avatar--}}
        <div>
            <x-form.label for="avatar" value="{{ __('Avatar') }}"/>
            <div class="flex justify-center">
                @if($avatar)
                    <img src="{{ $avatar->temporaryUrl() }}" class="max-w-full" alt="avatar">
                @elseif($hasAvatar)
                    <img src="{{ $avatarPath }}" class="max-w-full" alt="avatar">
                @endif
            </div>
            <div class="mt-4 text-center">
                <input
                    wire:model="avatar"
                    id="file"
                    class="inputfile"
                    type="file"
                    name="avatar"
                />
                <label
                    for="file"
                    class="items-center px-4 py-2 bg-blue-500 rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-700 focus:bg-blue-700 transition ease-in-out duration-150"
                >
                    {{ __('Upload new avatar') }}
                </label>
            </div>
        </div> {{-- End Avatar --}}
    </div>

    <div class="mt-4 flex justify-end px-4 py-2">
        <x-form.button
            wire:click="submit"
        >
            {{ __('Save') }}
        </x-form.button>
    </div>
</div>
