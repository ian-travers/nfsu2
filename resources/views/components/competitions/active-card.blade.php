@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div class="p-4 md:p-8 bg-nfsu-color bg-opacity-50 border border-blue-400">
    <h2 class="text-center text-xl md:text-3xl tracking-wider font-medium">
        {{ __('Current competition') }}
    </h2>
    @if($competition)
        <x-competitions.active-card-header class="mt-2" :competition="$competition"/>
        <div class="mt-4">
            <p class="text-center text-2xl mb-2">{{ __('Summary') }}</p>
            <x-competitions._table :rating="$competition->standing()" :resultAlignRight="false"/>
        </div>
        <div class="grid gap-4 grid-cols-1 md:gap-6 md:grid-cols-2 mt-8">
            @foreach($competition->ratingsPerTrack() as $trackName => $rating)
                <div>
                    <h4 class="text-lg text-center mb-2">{{ $trackName }}</h4>
                    <div class="text-sm">
                        <x-competitions._table :rating="$rating" :resultAlignRight="true"/>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{ __('There is no active competition.') }}
    @endif
</div>

