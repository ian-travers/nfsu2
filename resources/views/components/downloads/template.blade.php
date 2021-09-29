@props(['file'])
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
                <div class="w-48">{{ __('Brief') }}</div>
                <div class="flex-1">
                    {{ $brief }}
                </div>
            </div>
            <div class="flex mt-6">
                <div class="w-48">
                    {{ __('Setup') }}
                </div>
                <div class="flex-1">
                    {{ $setup }}
                </div>
            </div>
            <div class="flex mt-6">
                <div class="w-48">
                    {{ __('See also') }}
                </div>
                <div class="flex-1">
                    {{ $see }}
                </div>
            </div>
        </div>
        <div class="w-96 mt-6 md:mt-0 pl-8">
            {{ $image }}
        </div>
    </div>

</div>

