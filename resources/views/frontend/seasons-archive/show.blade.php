@php /** @var \App\Models\Tourney\SeasonRacer $tourneyRacer */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <div class="flex items-center justify-between pt-4">
            <p>{{ __('Seasons archive') }}</p>
            <x-link href="{{ route('seasons-archive.index') }}">{{ __('All seasons') }}</x-link>
        </div>
        <h2 class="text-xl md:text-3xl my-2 md:my-4 text-center tracking-wider font-medium">{{ __('Tourney personal standings') }}</h2>

        {{-- Filters--}}
        <div class="sm:grid sm:grid-cols-3 sm:gap-1 lg:gap-4">
            <div class="mt-4 sm:mt-0">
                @include('frontend.season-standings._type-filter', ['route' => route('seasons-archive.show', $season)])
            </div>
        </div>
        {{-- End filters--}}

        <div class="mt-8">
            <x-rating.generic-table :racers="$tourneyRacers" type="tourney" :season="$season"/>
        </div>

        <h2 class="text-xl md:text-3xl mt-4 mb-2 md:mt-8 md:mb-4 text-center tracking-wider font-medium">{{ __('Competition personal standing') }}</h2>
        <div class="mt-8">
            <x-rating.generic-table :racers="$competitionRacers" type="competition" :season="$season"/>
        </div>
    </div>
</x-layouts.front>
