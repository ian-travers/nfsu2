<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Create team') }}</h3>
                </div>
                <p class="px-4 py-3 block">{{ __('Fill out the fields below to create a team') }}</p>

                <form action="{{ route('settings.team.store') }}" method="post" class="space-y-3 px-4 py-3">
                    @csrf
                    <div>
                        <x-form.label for="clan" value="{{ __('Clan') }}"/>
                        <x-form.input
                            class="block w-full mt-1"
                            type="text"
                            name="clan"
                            maxlength="12"
                            :value="old('clan')"
                            autofocus required
                            autocomplete="clan"
                        />
                        @error('clan')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <x-form.label for="name" value="{{ __('Full name') }}"/>
                        <x-form.input
                            class="block w-full mt-1"
                            type="text"
                            name="name"
                            maxlength="12"
                            :value="old('name')"
                            required
                            autocomplete="name"
                        />
                        @error('name')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <x-form.label for="password" value="{{ __('Team password') }}"/>
                        <x-form.input
                            class="block w-full mt-1"
                            type="text"
                            name="password"
                            maxlength="12"
                            :value="old('password')"
                            required
                            autocomplete="password"
                        />
                        @error('password')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <x-form.primary-button
                            type="submit"
                        >
                            {{ __('Create') }}
                        </x-form.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.settings>