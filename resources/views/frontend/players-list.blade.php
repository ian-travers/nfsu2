<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Players list') }}</h2>

        <div
            class="sm:grid sm:grid-cols-2 sm:gap-2 md:grid-cols-3 md:gap-3 lg:grid-cols-4 lg:gap-4 xl:grid-cols-5 xl:gap-4">
            @foreach($players as $player)
                <x-player-list-card :player="$player"></x-player-list-card>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $players->links('vendor.pagination.frontend') }}
        </div>
    </div>
</x-layouts.front>
