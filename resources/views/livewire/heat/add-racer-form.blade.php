<div>
    <div>
        <select
            wire:model.lazy="userId"
            id="racers_list"
            class="rounded-md w-full"
        >
            <option selected>{{ __('Select racer ...') }}</option>
            @foreach($racers as $id => $username)
                <option value="{{ $id }}">{{ $username }}</option>
            @endforeach
        </select>
        @error("userId")<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div class="flex justify-end mt-4 space-x-2">
        <x-form.secondary-button onclick="toggleModal()">
            {{ __('Cancel') }}
        </x-form.secondary-button>
        <x-form.primary-button wire:click="submit">
            {{ __('Add') }}
        </x-form.primary-button>
    </div>
</div>
