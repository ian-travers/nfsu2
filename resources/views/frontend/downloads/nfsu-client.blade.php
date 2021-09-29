<x-layouts.front title="{{ $title }}">
    <x-downloads.template :file="$file">
        <x-slot name="brief">
            {{ __('Utility for Need for Speed Underground multiplayer over internet or local network. Author 3PriedeZ.') }}
        </x-slot>
        <x-slot name="setup">
            {{ __('Unzip in any folder. Create a shortcut for the executable. For windows 7, 10 run as administrator.') }}
        </x-slot>
        <x-slot name="see">
            <x-link href="{{ route('downloads', 'nfsu') }}">{{ __('NFS Underground') }}</x-link>
        </x-slot>
        <x-slot name="image">
            <img src="{{ asset("storage/images/client-01.png") }}" alt="Client"/>
        </x-slot>
    </x-downloads.template>
</x-layouts.front>
