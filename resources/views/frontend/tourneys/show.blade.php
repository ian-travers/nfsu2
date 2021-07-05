@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <header class="text-center border-b border-blue-400 pb-3 md:pb-6">

            <h2 class="text-xl md:text-3xl mt-4 mb-2 md:mt-8 md:mb-4 tracking-wider font-medium">
                {{ $tourney->name }}
                <span class="mx-4">&#11088;</span>
                {{ $tourney->trackName() }}
            </h2>
            <p class="text-base md:text-lg">{{ Str::ucfirst($tourney->started_at->locale(app()->getLocale())->isoFormat('LLLL')) }}</p>

            <div class="flex items-center justify-between">
                <div>
                    <span class="text-gray-400">{{ Str::ucfirst(__('supervisor')) }}:</span>
                    {{ $tourney->supervisor_username }}
                </div>
                <x-tourney-status-badge :tourney="$tourney"/>
            </div>

            @if($tourney->description)
                <div class="text-left mt-4">
                    <span class="text-gray-400">{{ __('Additional information') }}:</span>
                    {{ $tourney->description }}
                </div>
            @endif
        </header>

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
</x-layouts.front>
