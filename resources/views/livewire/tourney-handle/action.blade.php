<div>
    <p class="my-6">
        <x-form.primary-button wire:click="$set('showDialog', true)">{{ $buttonCaption }}</x-form.primary-button>
    </p>

    <x-modals.light wire:model.defer="showDialog">
        <x-slot name="title">
            {{ __('Confirmation') }}
        </x-slot>
        {{ $confirmationMessage }}
        <x-slot name="footer">
            <x-form.secondary-button wire:click="$set('showDialog', false)">{{ __('Cancel') }}</x-form.secondary-button>
            <x-form.primary-button wire:click="handle">{{ __('Continue') }}</x-form.primary-button>
        </x-slot>
    </x-modals.light>
</div>
