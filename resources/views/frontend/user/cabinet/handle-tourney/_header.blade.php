@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<header>
    <div class="flex flex-col lg:flex-row items-center justify-between">
        <h3 class="text-xl lg:text-3xl">{{ $tourney->name }}</h3>
        <div class="space-x-2">

            @if($tourney->isEditable())
                <a href="{{ route('cabinet.tourneys.edit', $tourney) }}">
                    <x-form.primary-button>{{ __('Edit') }}</x-form.primary-button>
                </a>

                <form action="{{ route('cabinet.tourneys.delete', $tourney) }}" method="post" class="inline">
                    @csrf
                    @method('delete')
                    <x-form.danger-button
                        type="submit"
                        onclick="return confirm(_t('Confirm deleting?'))"
                    >
                        {{ __('Delete') }}
                    </x-form.danger-button>
                </form>
            @endif

            <a href="{{ route('cabinet.tourneys.index') }}">
                <x-form.primary-button>{{ __('My tourneys') }}</x-form.primary-button>
            </a>
        </div>
    </div>

    <div class="flex items-end justify-between">
        <div class="flex text-sm lg:text-base">
            <div class="w-32 text-gray-600">
                <p>{{ __('Type') }}</p>
                <p>{{ __('Track') }}</p>
                <p>{{ __('Date') }}</p>
                <p>{{ __('Room') }}</p>
            </div>
            <div>
                <p>{{ __(Str::ucfirst($tourney->type())) }}</p>
                <p>{{ $tourney->trackName() }}</p>
                <p>{{ $tourney->started_at->format('H:i d M Y') }}</p>
                <p>{{ $tourney->room }}</p>
            </div>
        </div>
        <div>
            <x-tourney-status-badge class="text-xl md:text-2xl" :tourney="$tourney"></x-tourney-status-badge>
        </div>
    </div>
</header>
