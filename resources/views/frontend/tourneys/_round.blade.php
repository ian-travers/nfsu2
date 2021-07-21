@php /** @var \App\Models\Tourney\Heat $heat */ @endphp

@if($round == 5)
    <p class="text-center text-lg font-medium mb-1">{{ __('Final round') }}</p>
    <div class="grid grid-cols-3">
        <div class="col-start-2">
            @foreach($heats as $heat)
                @include('frontend.tourneys._heat', ['racers' => $heat->racers])
            @endforeach
        </div>
    </div>
@else
    <p class="text-lg font-medium">{{ __('Round') }} #{{ $round }}</p>
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 xl:gap-6">
        @foreach($heats as $heat)
            <div>
                <p class="text-center mb-1">{{ __('Heat') }} #{{ $heat->heat_no }}</p>
                @include('frontend.tourneys._heat', ['racers' => $heat->racers])
            </div>
        @endforeach
    </div>
@endif

