<div>
    <x-form.warning-button wire:click="$set('showDialog', true)">{{ $buttonCaption }}</x-form.warning-button>

    <x-modals.confirm wire:model.defer="showDialog" bgClass="bg-nfsu-color">
        {{ $confirmationMessage }}
    </x-modals.confirm>
</div>
