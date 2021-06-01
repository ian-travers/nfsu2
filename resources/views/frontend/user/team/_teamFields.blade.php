<div>
    <x-form.label for="clan" value="{{ __('Clan') }}"/>
    <x-form.input
        id="clan"
        class="block w-full mt-1"
        type="text"
        name="clan"
        maxlength="12"
        value="{{ $team->clan, old('clan') }}"
        autofocus required
        autocomplete="clan"
    />
    @error('clan')
    <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
    @else
        <p class="text-gray-500 mt-1 text-xs">{{ __('Example: RR') }}</p>
        @enderror
</div>

<div>
    <x-form.label for="name" value="{{ __('Full name') }}"/>
    <x-form.input
        id="name"
        class="block w-full mt-1"
        type="text"
        name="name"
        maxlength="60"
        value="{{ $team->name, old('name') }}"
        required
        autocomplete="name"
    />
    @error('name')
    <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
    @else
        <p class="text-gray-500 mt-1 text-xs">{{ __('Example: Race Planet Racers') }}</p>
        @enderror
</div>

<div>
    <x-form.label for="password" value="{{ __('Team password') }}"/>
    <x-form.input
        id="password"
        class="block w-full mt-1"
        type="text"
        name="password"
        maxlength="16"
        value="{{ $team->password, old('password') }}"
        required
        autocomplete="password"
    />
    @error('password')
    <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
    @else
        <p class="text-gray-500 mt-1 text-xs">{{ __('4-16 characters') }}</p>
        @enderror
</div>

