<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900 mx-4">
        <div class="px-4 py-5 bg-white">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Create team') }}</h3>
                </div>
                <p class="px-4 py-3 block">{{ __('Fill out the fields below to create a team') }}</p>

                <form action="{{ route('settings.team.store') }}" method="post">
                    @csrf
                    <div class="space-y-3 px-4 py-3">
                        @include('frontend.user.team._teamFields')
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
                                {{ __('Create') }}
                            </x-form.primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.settings>
