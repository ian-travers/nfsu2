@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div class="transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 rounded-lg h-full px-4 py-2">
    <p>
        <span class="text-gray-300">#{{ $competition->id }}</span>
        {{ $competition->started_at->format('Y-m-d') }}
        &mdash;
        {{ $competition->ended_at->format('Y-m-d') }}
    </p>
    <div class="py-2">
        <p class="text-sm">
            {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track1_id) }}
        </p>
        @if($competition->track2_id)
            <p class="text-sm">
                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track2_id) }}
            </p>
        @endif
        @if($competition->track3_id)
            <p class="text-sm">
                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track3_id) }}
            </p>
        @endif
        @if($competition->track4_id)
            <p class="text-sm">
                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track4_id) }}
            </p>
        @endif
    </div>
</div>
