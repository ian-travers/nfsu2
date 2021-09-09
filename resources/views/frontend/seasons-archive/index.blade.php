<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Seasons archive') }}</h2>
        @if(count($seasons))
            <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-2 lg:gap-4 xl:gap-8">
                @foreach($seasons as $season)
                    <a href="{{ route('seasons-archive.show', $season) }}">
                        <div class="transition-colors duration-300 border border-gray-400 border-opacity-50 hover:border-opacity-100 bg-nfsu-color bg-opacity-75 hover:bg-opacity-100 hover:text-blue-300 rounded-lg h-full px-4 py-2">
                            <p class="text-base lg:text-lg xl:text-3xl text-center">
                                # {{ $season }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            {{ __('No information about archived seasons.') }}
        @endif
    </div>
</x-layouts.front>
