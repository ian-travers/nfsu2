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
    <div class="text-left">
        <span class="text-gray-400">{{ __('Room') }}:</span>
        {{ $tourney->room }}
    </div>

    @if($tourney->description)
        <div class="text-left mt-4">
            <span class="text-gray-400">{{ __('Additional information') }}:</span>
            {{ $tourney->description }}
        </div>
    @endif
</header>
