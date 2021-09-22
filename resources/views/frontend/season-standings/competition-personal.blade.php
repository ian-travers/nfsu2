@php /** @var \App\Models\Tourney\SeasonRacer $racer */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Competition personal standing') }}</h2>
        @if(count($racers))
        {{-- Table --}}
            <div class="mt-8">
                <x-rating.generic-table :racers="$racers" type="competition"/>
            </div>
        @else
            {{ __('There is no competitions yet.') }}
        @endif
    </div>
</x-layouts.front>
