@php /** @var \App\Models\Tourney\Heat $heat */ @endphp

@if($round == 5)
    <p class="text-center text-lg font-medium">{{ __('Final round') }}</p>
    <div class="grid grid-cols-3">
        <div class="col-start-2">
            @foreach($heats as $heat)
                <div>
                    <x-tourneys.heat :racers="$heat->racers" />
                </div>
            @endforeach
        </div>
    </div>
@else
    <p class="text-lg font-medium">{{ __('Round') }} #{{ $round }}</p>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 xl:gap-6">
        @foreach($heats as $heat)
            <div>
                <div class="flex items-center justify-center space-x-2 mb-1">
                    <p class="text-center">{{ __('Heat') }} #{{ $heat->heat_no }}</p>
                    <x-form.primary-button
                        type="button"
                        data-target="updateHeatResults"
                        data-heat-id="{{ $heat->id }}"
                        class="modal-open"
                    >
                        {{ __('Update result') }}
                    </x-form.primary-button>
                </div>
                <x-tourneys.heat :racers="$heat->racers" />
            </div>
        @endforeach
    </div>
@endif

