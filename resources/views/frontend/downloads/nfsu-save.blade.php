<x-layouts.front title="{{ $title }}">
    <x-downloads.template :file="$file">
        <x-slot name="brief">
            {{ __('Savegame profile files by Stox from XRT clan (ex RR).') }}<br>
            {{ __('All the underground mode events except the last are passed.') }}<br>
            {{ __('All magazine covers are opened.') }}<br>
            {{ __('XRT clan vinyls are presented.') }}
        </x-slot>
        <x-slot name="setup">
            {{ __('Unzip into:') }}<br>
            <span class="text-green-500 underline:none">c:\Documents and Settings\All Users\Application Data\</span>
            {{ __('for Windows XP') }}<br>
            <span class="text-green-500 underline:none">c:\Users\All Users\</span>
            {{ __('for Windows 7, 10.') }}
        </x-slot>
        <x-slot name="see">
            <x-link href="{{ route('downloads', 'nfsu-save-patcher') }}">{{ __('NFSU Save Patcher') }}</x-link>
        </x-slot>
        <x-slot name="image">
            <img src="{{ asset("storage/images/save-01.png") }}" alt="Saves"/>
        </x-slot>
    </x-downloads.template>
</x-layouts.front>
