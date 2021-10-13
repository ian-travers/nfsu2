<div>
    <button
        wire:click="$set('showDialog', true)"
        class="text-red-500 hover:text-red-400 hover:underline transition uppercase tracking-widest"
        style="font-size: .6rem; line-height: .8rem"
    >
        {{ __('Delete') }}
    </button>
    <x-modals.confirm wire:model.defer="showDialog" bgClass="bg-nfsu-color">
        {{ $confirmationMessage }}
    </x-modals.confirm>
</div>
