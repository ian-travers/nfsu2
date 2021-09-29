<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ $file->title() }}</h2>
        <div class="text-center mt-12">
            <a
                href="{{ $file->href }}"
                class="text-3xl border border-blue-400 rounded-lg hover:text-gray-50 hover:bg-blue-400 transition duration-500 px-36 py-4"
            >{{ __('Download') }}</a>
        </div>
        <div class="flex mt-6">
            <div class="w-48">{{ __('Size') }}</div>
            <div class="flex-1">{{ number_format($file->size, 0, '', ' ') }} {{ __('bytes') }} ({{ __('zip folder') }})</div>
        </div>
        <div class="flex mt-6">
            <div class="w-48">{{ __('Brief') }}</div>
            <div class="flex-1">
                {{ __('Need for Speed Underground video game of 2003. Arcade racing.') }}<br>
                {{ __('Developed by EA Black Box (ex Black Box Games).') }}<br>
                {{ __('Version: 1.4.') }}<br>
                {{ __('Language: english.') }}<br>
                {{ __('Features: no-cd, intro video was cut.') }}
            </div>
        </div>
        <div class="flex mt-6">
            <div class="w-48">{{ __('Setup') }}</div>
            <div class="flex-1">{{ __('Unzip to desired folder. Create a shortcut wherever you want for executable speed.exe. You can change shortcut icon by the NFSU_icon.ico. The game is ready to start.') }}</div>
        </div>
        <div class="flex mt-6">
            <div class="w-48">{{ __('See also') }}</div>
            <div class="flex-1">
                <x-link href="{{ route('downloads', 'nfsu-client') }}">{{ __('NFSU Client') }}</x-link>
            </div>
        </div>
    </div>
</x-layouts.front>
