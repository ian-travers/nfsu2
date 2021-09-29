<x-layouts.front title="{{ $title }}">
    <x-downloads.template :file="$file">
        <x-slot name="brief">
            {{ __('Save Patcher allows you edit NFS Underground savegame files.') }}<br>
            {{ __('Key feature: update car performance including TJ\'s unique parts sets.') }}<br>
            {{ __('Features: unlock some items, change money, change statistics, change style points.') }}
            <br>
            {{ __('Author mift0.') }}
        </x-slot>
        <x-slot name="setup">
            {{ __('Unzip to any folder.') }}<br>
            {{ __('Create a shortcut for executable.') }}
        </x-slot>
        <x-slot name="see">
            <x-link href="{{ route('downloads', 'nfsu-save') }}">{{ __('NFSU Save') }}</x-link>
        </x-slot>
        <x-slot name="image">
            <img src="{{ asset("storage/images/patcher-02.png") }}" alt="Patcher"/>
        </x-slot>
    </x-downloads.template>
</x-layouts.front>
