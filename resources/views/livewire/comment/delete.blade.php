<div>
    <button
        wire:click="$set('showDialog', true)"
        class="text-yellow-300 hover:text-yellow-200 hover:underline transition text-xs uppercase tracking-widest"
    >
        {{ __('Delete') }}
    </button>
    <x-modals.confirm wire:model.defer="showDialog" bgClass="bg-nfsu-color">
        {{ $confirmationMessage }}
    </x-modals.confirm>
</div>
