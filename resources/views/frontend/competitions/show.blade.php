@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <div class="text-sm mt-4">{{ __('Competition archive') }}</div>
        <h2 class="text-xl text-center md:text-3xl mt-4 mb-2 md:mt-8 md:mb-4 tracking-wider font-medium">
            <span class="text-gray-300">#{{ $competition->id }}</span>
            <span class="mx-4">&#11088;</span>
            {{ $competition->started_at->format('Y-m-d') }}
            &mdash;
            {{ $competition->ended_at->format('Y-m-d') }}
        </h2>
        <p class="text-center text-lg">
            {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track1_id) }}
            @if($competition->track2_id)
                <span class="text-gray-300"> | </span>
                <span>{{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track2_id) }}</span>
            @endif
            @if($competition->track3_id)
                <span class="text-gray-300"> | </span>
                <span>{{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track3_id) }}</span>
            @endif
            @if($competition->track4_id)
                <span class="text-gray-300"> | </span>
                <span>{{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track4_id) }}</span>
            @endif
        </p>
        <div class="mt-6">
            <p class="text-center text-2xl mb-2">{{ __('Summary') }}</p>
            <x-competitions._table :rating="$competition->standing()" :resultAlignRight="false"/>
        </div>

        @unless($competition->isCompleted())
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
        @endunless
    </div>
</x-layouts.front>
