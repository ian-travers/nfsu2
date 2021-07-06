@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('cabinet.tourneys.edit', $tourney) }}">
                    <x-form.primary-button>{{ __('Edit') }}</x-form.primary-button>
                </a>

                <form action="{{ route('cabinet.tourneys.delete', $tourney) }}" method="post">
                    @csrf
                    @method('delete')
                    <x-form.danger-button
                        type="submit"
                        onclick="return confirm()"
                    >
                        {{ __('Delete') }}
                    </x-form.danger-button>
                </form>

                <a href="{{ route('cabinet.tourneys.index') }}">
                    <x-form.primary-button>{{ __('My tourneys') }}</x-form.primary-button>
                </a>
            </div>

            <div class="flex items-start justify-between mt-4">
                <div class="flex">
                    <div class="w-32">
                        <p>{{ __('Type') }}</p>
                        <p>{{ __('Track') }}</p>
                        <p>{{ __('Date') }}</p>
                        <p>{{ __('Status') }}</p>
                    </div>
                    <div>
                        <p>{{ __(Str::ucfirst($tourney->type())) }}</p>
                        <p>{{ $tourney->trackName() }}</p>
                        <p>{{ $tourney->started_at->format('H:i d M Y') }}</p>
                        <p>{{ __(Str::ucfirst($tourney->status)) }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-3xl">{{ $tourney->name }}</p>
                </div>
            </div>

            {{-- Operations--}}
            <div class="border-t border-b border-blue-200 space-x-2 py-3 mt-4">
                <p class="inline">{{ __('Handling') }}:</p>
                <x-form.primary-button>{{ __('Random draw') }}</x-form.primary-button>
                <x-form.primary-button>{{ __('Approve the draw and start the tourney') }}</x-form.primary-button>
                <x-form.primary-button>{{ __('Announce the final round') }}</x-form.primary-button>
                <x-form.primary-button>{{ __('Complete the tourney') }}</x-form.primary-button>
            </div>

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
    </div>
</x-layouts.cabinet>
