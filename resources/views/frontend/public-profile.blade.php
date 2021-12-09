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
                    <span class="text-xs block">
                        {{ Str::ucfirst(__($user->role)) }}
                    </span>
                    <span class="text-sm block mt-1">
                        {{ __('Member sings :date', ['date' => $user->created_at->diffForHumans()]) }}
                    </span>
                    @if($user->isTeamMember())
                        <p class="mt-8 text-base">{{ __('Team') }}:
                            <a href="{{ route('team-profile', $user->team) }}">
                                <span
                                    class="inline-flex items-center px-3 py-0.5 rounded text-xl bg-gray-600 text-green-400 hover:underline">
                                {{ $user->team->clan }}
                            </span>
                            </a>

                            <span class="text-gray-400 ml-1">{{ $user->team->name }}</span>
                        </p>
                    @endif
                </div>
                <div class="flex items-baseline">
                    <span class="fflag ff-lg ff-wave fflag-{{ $user->country }}"></span>
                    <span class="text-xs ml-2">{{ \App\Models\Country::name($user->country) }}</span>
                </div>
            </div>
            <div>
                <div class="flex justify-center items-start">
                    <x-profile-panel>
                        <p class="text-lg font-bold">{{ __('Tourneys') }}</p>
                        <span class="text-6xl">{{ $user->tourneys_finished_count }}</span>
                        <span class="text-4xl"> / </span>
                        <span class="text-2xl">{{ $user->tourneyPodiums }}</span>
                    </x-profile-panel>
                    <x-profile-panel>
                        <p class="text-lg font-bold">{{ __('Competitions') }}</p>
                        <span class="text-6xl">{{ $user->competitions_count }}</span>
                        <span class="text-4xl"> / </span>
                        <span class="text-2xl">{{ $user->competitionPodiums }}</span>
                    </x-profile-panel>
                </div>
            </div>
        </div>

        @if($user->seasonAwards()->count())
            <div class="flex items-baseline mt-8 space-x-4">
                <h3 class="text-2xl">{{ __('Season awards') }}</h3>
                <div class="flex-1">
                    <div class="flex">
                        @foreach($user->seasonAwards as $seasonAward)
                            <div class="inline-block h-8 w-8 transform transition hover:scale-125">
                                <a href="{{ route('seasons-archive.show', $seasonAward->season_index) }}"
                                   title="{{ $seasonAward->htmlTitleAttribute() }}">
                                    <x-season-award
                                        place="{{ $seasonAward->place }}"
                                        type="{{ $seasonAward->type }}"
                                        size="12"
                                    />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($user->trophies()->count())
            <div class="flex mt-8 space-x-4">
                <h3 class="text-2xl">{{ __('Trophies') }}</h3>
                <div class="flex-1">
                    <div class="flex">
                        @foreach($user->trophies as $trophy)
                            @if($trophy->trophiable_type == "tourney")
                                <div class="inline-block h-8 w-8 transform transition hover:scale-125">
                                    <a href="{{ route('tourneys.show', $trophy->trophiable) }}"
                                       title="{{ $trophy->htmlTitleAttribute() }}">
                                        <x-tourney-medal
                                            place="{{ $trophy->place }}"
                                            type="{{ $trophy->trophiable->type() }}"
                                            size="8"
                                        />
                                    </a>
                                </div>
                            @endif
                            @if($trophy->trophiable_type == "competition")
                                <div class="inline-block h-8 w-8 transform transition hover:scale-125">
                                    <a href="{{ route('competitions.show', $trophy->trophiable) }}"
                                       title="{{ $trophy->htmlTitleAttribute() }}">
                                        <x-competition-medal
                                            place="{{ $trophy->place }}"
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

        <div class="mt-8">
            <p class="text-2xl">{{ __('Site points') }}: {{ $user->site_points }}</p>
        </div>
    </div>
</x-layouts.front>
