<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ $file->title() }}</h2>
        <div class="text-center mt-12">
            <a
                href="{{ $file->href }}"
                class="text-3xl border border-blue-400 rounded-lg hover:text-gray-50 hover:bg-blue-400 transition duration-500 px-36 py-4"
            >{{ __('Download') }}</a>
        </div>
        <div class="flex-none md:flex mt-8">
            <div class="flex-1">
                <div class="flex mt-6">
                    <div class="w-48">{{ __('Size') }}</div>
                    <div class="flex-1">
                        {{ number_format($file->size, 0, '', ' ') }}
                        {{ __('bytes') }}
                        ({{ __('zip folder') }})
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-48">
                        {{ __('Brief') }}
                    </div>
                    <div class="flex-1">
                        {{ __('Savegame profile files by Stox from XRT clan (ex RR).') }}<br>
                        {{ __('All the underground mode events except the last are passed.') }}<br>
                        {{ __('All magazine covers are opened.') }}<br>
                        {{ __('XRT clan vinyls are presented.') }}
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-48">
                        {{ __('Setup') }}
                    </div>
                    <div class="flex-1">
                        {{ __('Unzip into:') }}<br>
                        <span class="text-green-500 underline:none">c:\Documents and Settings\All Users\Application Data\</span>
                        {{ __('for Windows XP') }}<br>
                        <span class="text-green-500 underline:none">c:\Users\All Users\</span>
                        {{ __('for Windows 7, 10.') }}<br>
                    </div>
                </div>
                <div class="flex mt-6">
                    <div class="w-48">
                        {{ __('See also') }}
                    </div>
                    <div class="flex-1">
                        <x-link href="{{ route('downloads', 'nfsu-save-patcher') }}">{{ __('NFSU Save Patcher') }}</x-link>
                    </div>
                </div>
            </div>
            <div class="w-96 mt-6 md:mt-0 pl-8">
                <img src="{{ asset("storage/images/save-01.png") }}" alt="Saves"/>
            </div>
        </div>
    </div>
</x-layouts.front>
