<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Tourney archive') }}</h2>
        <x-tourneys.grid :featuredTourneys="$featuredTourneys ?? []" :tourneys="$tourneys"/>
    </div>
</x-layouts.front>
