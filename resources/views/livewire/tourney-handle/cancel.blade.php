<div>
    <p class="my-6">
        <x-form.primary-button wire:click="$set('showDialog', true)">{{ __('Cancel the tourney') }}</x-form.primary-button>
    </p>

    <x-modals.light wire:model.defer="showDialog">
        <x-slot name="title">
            {{ __('Confirmation') }}
        </x-slot>
            {{ __('Now the tourney will be cancelled. Continue?') }}
        <x-slot name="footer">
            <x-form.secondary-button wire:click="$set('showDialog', false)">{{ __('Cancel') }}</x-form.secondary-button>
            <x-form.primary-button wire:click="handle">{{ __('Continue') }}</x-form.primary-button>
        </x-slot>
    </x-modals.light>
</div>
