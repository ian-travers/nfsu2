@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<h2 class="text-center text-xl md:text-3xl">{{ __('Choose one or several tracks for the competition') }}</h2>

<x-backend.form-panel class="px-4 py-8 my-8">
    <div class="md:grid md:grid-cols-2 md:gap-4 xl:grid-cols-4">
        <div>
            <select
                id="track1_id"
                name="track1_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            >
                <x-form.track-select-optgroup :title="__('Circuit')" :tracks="$circuits" :currentTrack="$competition->track1_id"/>
                <x-form.track-select-optgroup :title="__('Sprint')" :tracks="$sprints" :currentTrack="$competition->track1_id"/>
                <x-form.track-select-optgroup :title="__('Drag')" :tracks="$drags" :currentTrack="$competition->track1_id"/>
                <x-form.track-select-optgroup :title="__('Drift')" :tracks="$drifts" :currentTrack="$competition->track1_id"/>
            </select>
            @error('track1_id')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <select
                id="track2_id"
                name="track2_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            >
                <option value="">{{ __('No') }}</option>
                <x-form.track-select-optgroup :title="__('Circuit')" :tracks="$circuits" :currentTrack="$competition->track2_id"/>
                <x-form.track-select-optgroup :title="__('Sprint')" :tracks="$sprints" :currentTrack="$competition->track2_id"/>
                <x-form.track-select-optgroup :title="__('Drag')" :tracks="$drags" :currentTrack="$competition->track2_id"/>
                <x-form.track-select-optgroup :title="__('Drift')" :tracks="$drifts" :currentTrack="$competition->track2_id"/>
            </select>
            @error('track2_id')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <select
                id="track3_id"
                name="track3_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            >
                <option value="">{{ __('No') }}</option>
                <x-form.track-select-optgroup :title="__('Circuit')" :tracks="$circuits" :currentTrack="$competition->track3_id"/>
                <x-form.track-select-optgroup :title="__('Sprint')" :tracks="$sprints" :currentTrack="$competition->track3_id"/>
                <x-form.track-select-optgroup :title="__('Drag')" :tracks="$drags" :currentTrack="$competition->track3_id"/>
                <x-form.track-select-optgroup :title="__('Drift')" :tracks="$drifts" :currentTrack="$competition->track3_id"/>
            </select>
            @error('track3_id')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <select
                id="track4_id"
                name="track4_id"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            >
                <option value="">{{ __('No') }}</option>
                <x-form.track-select-optgroup :title="__('Circuit')" :tracks="$circuits" :currentTrack="$competition->track4_id"/>
                <x-form.track-select-optgroup :title="__('Sprint')" :tracks="$sprints" :currentTrack="$competition->track4_id"/>
                <x-form.track-select-optgroup :title="__('Drag')" :tracks="$drags" :currentTrack="$competition->track4_id"/>
                <x-form.track-select-optgroup :title="__('Drift')" :tracks="$drifts" :currentTrack="$competition->track4_id"/>
            </select>
            @error('track4_id')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <x-form.label for="started_at" value="{{ __('Started at') }}"/>
            <x-form.input
                id="started_at"
                class="block mt-1 w-full"
                type="date"
                min="{{ now()->format('Y-m-d') }}"
                name="started_at"
                value="{{ old('started_at', $competition->started_at->format('Y-m-d')) }}"
            />
            @error('started_at')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <x-form.label for="started_at" value="{{ __('Ended at') }}"/>
            <x-form.input
                id="ended_at"
                class="block mt-1 w-full"
                type="date"
                min="{{ now()->addDay()->format('Y-m-d') }}"
                max="{{ now()->addMonth()->format('Y-m-d') }}"
                name="ended_at"
                value="{{ old('ended_at', $competition->ended_at->format('Y-m-d')) }}"
            />
            @error('ended_at')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>
    </div>
</x-backend.form-panel>
