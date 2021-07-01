@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<div
    class="flex items-center justify-between transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 rounded-lg px-4 py-2"
>
    <div class="mr-4">
        <img src="{{ asset("storage/images/{$tourney->type()}.png") }}" alt="int" class="rounded-lg">
    </div>

    <div class="flex-1">
        <div class="flex items-end justify-between">
            <div>
                <div class="">{{ $tourney->name }}</div>
                <div class="">{{ \App\Models\NFSUServer\SpecificGameData::getTrackName($tourney->track_id) }}</div>
                <div class="">{{ $tourney->started_at->format('Y-m-d H:i') }}</div>
                <x-tourney-status-badge :tourney="$tourney"/>
            </div>
            <div>
                <a href="#">
                    @if($tourney->isCompleted())
                        <x-form.success-button>{{ __('Results') }}</x-form.success-button>
                    @else
                        <x-form.primary-button>{{ __('Details') }}</x-form.primary-button>
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>
