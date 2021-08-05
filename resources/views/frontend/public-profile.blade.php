@php /** @var \App\Models\User $user */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Public profile') }}</h2>

        <div class="flex items-start space-x-8">
            <div class="flex-shrink-0">
                @livewire('user.avatar', ['user' => $user, 'size' => 32])
            </div>
            <div class="flex flex-1 space-x-4">
                <div class="text-4xl">
                    {{ $user->username }}
                    <span
                        class="text-sm block">{{ __('Member sings :date', ['date' => $user->created_at->diffForHumans()]) }}</span>
                </div>
                <div class="flex items-baseline">
                    <span class="fflag ff-lg ff-wave fflag-{{ $user->country }}"></span>
                    <span
                        class="text-xs ml-2">{{ \App\Models\CountriesList::all(app()->getLocale())[$user->country] }}</span>
                </div>
            </div>
            <div>
                <div class="flex justify-center items-start">
                    <x-profile-panel>
                        <p class="text-lg font-bold">{{ __('Tourneys') }}</p>
                        <span class="block text-6xl py-2">{{ $user->tourneys_finished_count }}</span>
                    </x-profile-panel>
                    <x-profile-panel>
                        <p class="text-lg font-bold">{{ __('Podiums') }}</p>
                        <span class="block text-6xl py-2">{{ $user->podiums }}</span>
                    </x-profile-panel>
                </div>
            </div>
        </div>

        @if($user->trophies()->count())
            <div class="flex mt-8 space-x-4">
                <h3 class="text-2xl">{{ __('Trophies') }}</h3>
                <div class="flex-1">
                    <div class="flex">
                        @foreach($user->trophies as $trophy)
                            @if($trophy->trophiable_type = "tourney")
                                <div class="inline-block h-8 w-8">
                                    <a href="{{ route('tourneys.show', $trophy->trophiable) }}" title="{{ $trophy->htmlTitleAttribute() }}">
                                        <x-trophy-medal
                                            place="{{ $trophy->place }}"
                                            type="{{ $trophy->trophiable->type() }}"
                                            size="8"
                                        />
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        <div class="flex items-center space-x-4 mt-8">
            <h3 class="text-2xl">{{ __('Achievements') }}</h3>
            <div class="flex-1">
                Achievements icons
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-2xl">{{ __('Site points') }}: {{ $user->site_points }}</h3>
        </div>
    </div>
</x-layouts.front>
