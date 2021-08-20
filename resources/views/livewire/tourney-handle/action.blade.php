<div>
    <p class="my-6">
        <x-form.primary-button wire:click="$set('showDialog', true)">{{ $buttonCaption }}</x-form.primary-button>
    </p>

    <x-modals.confirm-light wire:model.defer="showDialog">
        {{ $confirmationMessage }}
    </x-modals.confirm-light>
</div>
