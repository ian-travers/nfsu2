<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Edit team') }}</h3>
                </div>

                <form action="{{ route('settings.team.update') }}" method="post" class="space-y-3 px-4 py-3">
                    @csrf
                    @method('patch')
                    <div>
                        <x-form.label for="clan" value="{{ __('Clan') }}"/>
                        <input
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
                            class="block w-full mt-1"
                            type="text"
                            name="name"
                            maxlength="12"
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
                            class="block w-full mt-1"
                            type="text"
                            name="password"
                            maxlength="12"
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
                    <div class="flex items-center justify-end space-x-4">
                        <a
                            class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('settings.team.index') }}"
                        >
                            {{ __('Cancel') }}
                        </a>

                        <x-form.primary-button
                            type="submit"
                        >
                            {{ __('Update') }}
                        </x-form.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.settings>
