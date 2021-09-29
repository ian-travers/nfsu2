<x-layouts.front title="{{ $title }}">
    <x-downloads.template :file="$file">
        <x-slot name="brief">
            {{ __('Need for Speed Underground video game of 2003. Arcade racing.') }}<br>
            {{ __('Developed by EA Black Box (ex Black Box Games).') }}<br>
            {{ __('Version: 1.4.') }}<br>
            {{ __('Language: english.') }}<br>
            {{ __('Features: no-cd, intro video was cut.') }}
        </x-slot>
        <x-slot name="setup">
            {{ __('Unzip to desired folder. Create a shortcut wherever you want for executable speed.exe. You can change shortcut icon by the NFSU_icon.ico. The game is ready to start.') }}
        </x-slot>
        <x-slot name="see">
            <x-link href="{{ route('downloads', 'nfsu-client') }}">{{ __('NFSU Client') }}</x-link>
        </x-slot>
        <x-slot name="image">
            <img src="{{ asset("storage/images/nfsu-cover.jpg") }}" alt="Cover"/>
        </x-slot>
    </x-downloads.template>
</x-layouts.front>

