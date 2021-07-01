<div
    class="flex items-center justify-between transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 rounded-lg px-6 py-4 max-w-4xl mx-auto">
    <div class="mr-6">
        <img src="{{ asset("storage/images/{$tourney->type()}.png") }}" width="160" height="90" alt="race-type"
             class="rounded-lg">
    </div>
    <div class="flex-1 flex justify-between">
        <div class="space-y-3">
            <div class="text-2xl font-semibold">{{ $tourney->name }}</div>
            <div class="text-lg font-medium">{{ __('Track') }}
                : {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($tourney->track_id) }}</div>
            <div>{{ __('Starts at') }}: <time class="font-mono">{{ $tourney->started_at->format('H:i Y-m-d') }}</time></div>
            <div class="uppercase">{{ __('Room') }}: {{ $tourney->room }}</div>
            <div>{{ __('Supervisor') }}: {{ $tourney->supervisor_username }}</div>
            <div class="text-gray-400 text-sm">{{ $tourney->description }}</div>
            <x-tourney-status-badge :tourney="$tourney"/>
        </div>
        <div class="flex flex-col items-end">
            <div class="">
                <a href="#">
                    @if($tourney->isSigningUp())
                        <x-form.success-button>{{ __('Sign Up') }}</x-form.success-button>
                    @endif
                </a>
            </div>
            <div class="flex-grow">&nbsp;</div>
            <div class="">
                <a href="#">
                    <x-form.primary-button>{{ __('Details') }}</x-form.primary-button>
                </a>
            </div>
        </div>
    </div>
</div>
