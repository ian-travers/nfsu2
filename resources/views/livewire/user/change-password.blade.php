<div>
    <div class="mt-4">
        <x-form.label for="password" value="{{ __('Password') }}"/>
        <x-form.input
            wire:model.lazy="password"
            class="block mt-1 w-full"
            type="password"
            name="password"
            autofocus required
        />
    </div>
    <div class="mt-4">
        <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
        <x-form.input
            wire:model.lazy="password_confirmation"
            class="block mt-1 w-full"
            type="password"
            name="password_confirmation"
            required
        />
    </div>
    @error('password')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror

    <div class="flex justify-end mt-4 space-x-2">
        <x-form.secondary-button onclick="toggleModal()">
            {{ __('Cancel') }}
        </x-form.secondary-button>
        <x-form.primary-button wire:click="submit">
            {{ __('Persist new password') }}
        </x-form.primary-button>
    </div>
</div>
