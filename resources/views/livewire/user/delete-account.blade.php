<div>
    <p class="font-semibold text-xl my-2">{{ __('Are you sure you want to do this?') }}</p>
    <div class="bg-red-100 px-6 py-8 -mx-6 flex items-center">
        <svg class="h-8 w-8 text-red-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <p class="pl-4">
            {{ __('This is extremely important.') }}
        </p>
    </div>

    <div class="mt-2">
        {{ __('I will immediately delete your account. All of your tourney result, posts and comments will remind on the site signed with your username.') }}
    </div>

    <div class="mt-2">
        {{ __('Your username will be not available to registration on NFSU Cup.') }}
    </div>

    <div class="mt-4">
        <x-form.label for="email" value="{{ __('Your email') }}"/>
        <x-form.input
            wire:model.lazy="email"
            class="block mt-1 w-full"
            type="text"
            name="email"
            autofocus required
        />
    </div>
    @error('email')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror

    <div class="mt-4">
        <label for="phrase">
            {{ __('To verify, type') }}
            <em class="font-semibold">delete my account right now</em>
            {{ __('below') }}
        </label>
        <x-form.input
            wire:model.lazy="phrase"
            class="block mt-1 w-full"
            type="text"
            name="phrase"
            required
        />
    </div>
    @error('phrase')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror

    <div class="flex justify-end mt-4 space-x-2">
        <x-form.secondary-button onclick="toggleModal()">
            {{ __('Cancel') }}
        </x-form.secondary-button>
        <x-form.danger-button
            wire:click="submit"
        >
            {{ __('Delete this account') }}
        </x-form.danger-button>
    </div>
</div>
