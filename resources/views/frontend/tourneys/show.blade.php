@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        @include('frontend.tourneys._header')

        <div class="mt-3 md:mt-6">
            <div
                class="flex flex-col items-center space-y-3 md:flex-row md:items-start md:justify-around md:space-y-0 md:space-x-4">
                <div class="md:w-1/6">
                    <p class="text-lg font-medium mb-1">{{ __('Signed up') }}</p>
                    <x-tourneys.signedup-table :tourney="$tourney"/>
                </div>
                <div class="md:w-2/5">
                    <p class="text-lg font-medium mb-1">{{ __('Standings') }}</p>
                    <x-tourneys.standings-table :tourney="$tourney"/>
                </div>
            </div>
        </div>
    </div>

    @if($tourney->heats()->count())
        <div class="mt-6 max-w-screen-2xl mx-auto text-blue-400">
            @for($round = 1; $round <= 5; $round++)
                <div class="p-4 my-8">
                    @include('frontend.tourneys._round', [
    'round' => $round,
    'heats' => $tourney->heats()->where('round', $round)->orderBy('heat_no')->get()
    ])
                </div>
            @endfor
        </div>
    @endif
</x-layouts.front>
