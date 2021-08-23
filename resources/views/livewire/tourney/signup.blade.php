<div>
    <x-form.success-button wire:click="$set('showDialog', true)">{{ $buttonCaption }}</x-form.success-button>

    <x-modals.confirm wire:model.defer="showDialog" bgClass="bg-nfsu-color">
        {{ $confirmationMessage }}
    </x-modals.confirm>
</div>
