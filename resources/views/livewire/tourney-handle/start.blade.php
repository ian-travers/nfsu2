<div>
    <p class="my-6">
        <x-form.primary-button wire:click="$set('showDialog', true)">{{ __('Approve the draw and start the tourney') }}</x-form.primary-button>
    </p>

    <x-modals.light wire:model.defer="showDialog">
        <x-slot name="title">
            {{ __('Confirmation') }}
        </x-slot>
        {{ __('Now the heats will be available for viewing on the tourney page. Continue?') }}
        <x-slot name="footer">
            <x-form.secondary-button wire:click="$set('showDialog', false)">{{ __('Cancel') }}</x-form.secondary-button>
            <x-form.primary-button wire:click="handle">{{ __('Continue') }}</x-form.primary-button>
        </x-slot>
    </x-modals.light>
</div>
