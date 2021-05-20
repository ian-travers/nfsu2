<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Join team') }}</h3>
                </div>
                <p class="px-4 py-3 block">{{ __('Fill out the fields below to join') }}</p>

                <form action="{{ route('settings.team.join.store') }}" method="post" class="space-y-3 px-4 py-3">
                    @csrf
                    <div>
                        <x-form.label for="team_id" value="{{ __('Clan > Name') }}"/>
                        <select
                            id="team_id"
                            name="team_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
                        >
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->clan . ' > ' . $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-form.label for="password" value="{{ __('Team password') }}"/>
                        <x-form.input
                            id="password"
                            class="block w-full mt-1"
                            type="password"
                            name="password"
                            maxlength="16"
                            :value="old('password')"
                            required
                            autocomplete="password"
                        />
                        @error('password')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
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
                            {{ __('Join') }}
                        </x-form.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.settings>
