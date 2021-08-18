<div>
    <p class="my-6">
        <x-form.danger-button wire:click="$set('showDialog', true)">Confirm Dialog</x-form.danger-button>
    </p>

    <x-modals.modal wire:model.defer="showDialog">
        <x-slot name="title">
            Are ?
        </x-slot>
        This is a body part
        <x-slot name="footer">
            <x-form.secondary-button wire:click="$set('showDialog', false)">Cancel</x-form.secondary-button>
            <x-form.primary-button wire:click="handle">Confirm</x-form.primary-button>
        </x-slot>
    </x-modals.modal>
</div>
