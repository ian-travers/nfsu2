@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="col-span-2 lg:col-span-4">
        <x-form.label for="name" value="{{ __('Name') }}"/>
        <x-form.input
            id="name"
            class="block mt-1 w-full"
            type="text"
            name="name"
            value="{{ old('name', $tourney->name) }}"
            autofocus
            autocomplete="name"
        />
        @error('name')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="track_id" value="{{ __('Track') }}"/>
        <select
            id="track_id"
            name="track_id"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
        >
            <optgroup label="{{ __('Circuit') }}">
                @foreach($circuits as $id => $name)
                    <option value="{{ $id }}" {{ $id == $tourney->track_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="{{ __('Sprint') }}">
                @foreach($sprints as $id => $name)
                    <option value="{{ $id }}" {{ $id == $tourney->track_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="{{ __('Drag') }}">
                @foreach($drags as $id => $name)
                    <option value="{{ $id }}" {{ $id == $tourney->track_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="{{ __('Drift') }}">
                @foreach($drifts as $id => $name)
                    <option value="{{ $id }}" {{ $id == $tourney->track_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </optgroup>
        </select>
        @error('track_id')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="started_at" value="{{ __('Date') }}"/>
        <x-form.input
            id="started_at"
            class="block mt-1 w-full"
            type="datetime-local"
            name="started_at"
            value="{{ old('started_at', $tourney->started_at ? $tourney->started_at->format('Y-m-d\TH:i') : '') }}"
            autofocus
            autocomplete="started_at"
        />
        @error('started_at')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="signup_time" value="{{ __('Signup time') }}, {{ __('min.') }}"/>
        <select
            id="signup_time"
            name="signup_time"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
        >
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
            <option value="60">60</option>
        </select>
        @error('signup_time')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="room" value="{{ __('Room') }}"/>
        <x-form.input
            id="room"
            class="block mt-1 w-full"
            type="text"
            name="room"
            value="{{ old('room', $tourney->room ?: 'TOURNEY') }}"
            autocomplete="room"
        />
        @error('room')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div class="col-span-2 lg:col-span-4">
        <x-form.label for="description" value="{{ __('Additional information') }}"/>
        <textarea
            id="description"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            type="text"
            name="description"
        >{{ old('description', $tourney->description) }}</textarea>
        @error('description')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
</div>

