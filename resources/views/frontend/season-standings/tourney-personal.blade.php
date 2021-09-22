@php /** @var \App\Models\Tourney\SeasonRacer $racer */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Tourney personal standings') }}</h2>
        @if(count($racers))
        {{-- Filters--}}
        <div class="sm:grid sm:grid-cols-3 sm:gap-1 lg:gap-4">
            <div class="mt-4 sm:mt-0">
                @include('frontend.season-standings._type-filter', ['route' => route('season-standings.tourney-personal')])
            </div>
            <div class="mt-4 sm:mt-0">
                @include('frontend.season-standings._country-filter')
            </div>
            <div class="mt-4 sm:mt-0">
                @include('frontend.season-standings._team-filter')
            </div>
        </div>
        {{-- End filters--}}

        {{-- Table --}}
        <div class="mt-8">
            <x-rating.generic-table :racers="$racers" type="tourney"/>
        </div>
        @else
            {{ __('There is no tourneys yet.') }}
        @endif
    </div>
</x-layouts.front>
