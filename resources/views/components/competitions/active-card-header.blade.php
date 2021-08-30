@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div {{ $attributes(['class' => 'mx-auto']) }}>
    <p class="text-lg text-center">
        <span class="text-gray-500">#{{ $competition->id }}</span>
        {{ $competition->started_at->format('Y-m-d') }}
        &mdash;
        {{ $competition->ended_at->format('Y-m-d') }}
    </p>
    <p class="text-md mt-4">
        <span class="text-gray-300">{{ __('Competition tracks') }}:</span>
        @foreach($competition->ratingsPerTrack()->keys() as $trackName)
            {{ $trackName }}
            @unless($loop->last)
                <span class="text-gray-300">|</span>
            @endunless
        @endforeach
    </p>
</div>
