@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<div
    class="flex items-start justify-between transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 rounded-lg px-6 py-4 max-w-4xl mx-auto">
    <div class="mr-6">
        <img src="{{ asset("storage/images/{$tourney->type()}.png") }}" width="160" height="90" alt="race-type"
             title="{{ $tourney->type() }}" class="rounded-lg">
    </div>
    <div class="flex-1 flex justify-between">
        <div class="space-y-2">
            <div class="text-2xl font-semibold">{{ $tourney->name }}</div>
            <div class="text-lg font-medium">
                <span class="text-gray-400"> {{ __('Track') }}:</span>
                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($tourney->track_id) }}
            </div>
            <div>
                <span class="text-gray-400">{{ __('Starts at') }}:</span>
                <time class="font-mono">{{ $tourney->started_at->format('H:i Y-m-d') }}</time>
            </div>
            <div>
                <span class="text-gray-400">{{ __('Room') }}:</span>
                <span class="uppercase">{{ $tourney->room }}</span>
            </div>
            <div>
                <span class="text-gray-400">{{ __('Supervisor') }}:</span>
                 {{ $tourney->supervisor_username }}
            </div>
            <div class="text-sm">{{ $tourney->description }}</div>
        </div>
        <div class="flex flex-col items-end">
            <div>
                @if($tourney->isSigningUp())
                    <form action="{{ route('tourneys.signup', $tourney) }}" method="post">
                        @csrf
                        <x-form.success-button type="submit">{{ __('Sign Up') }}</x-form.success-button>
                    </form>
                @endif
            </div>
            <div class="mt-4 self-center">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full font-semibold bg-green-100 text-green-800"
                >
                    {{ $tourney->details()->count() }}
                </span>
            </div>
            <div class="flex-grow">&nbsp;</div>
            <div>
                <a href="#">
                    <x-form.primary-button>{{ __('Details') }}</x-form.primary-button>
                </a>
            </div>
        </div>
    </div>
</div>
