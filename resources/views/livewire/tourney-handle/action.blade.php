<div>
    <x-form.primary-button wire:click="$set('showDialog', true)">{{ $buttonCaption }}</x-form.primary-button>

    <x-modals.confirm wire:model.defer="showDialog">
        {{ $confirmationMessage }}
    </x-modals.confirm>
</div>
