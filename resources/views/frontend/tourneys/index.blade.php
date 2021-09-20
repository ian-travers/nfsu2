<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Tourneys') }}</h2>
        @if(count($featuredTourneys) || count($tourneys))
            <x-tourneys.grid :featuredTourneys="$featuredTourneys" :tourneys="$tourneys"/>
        @else
            <div class="mt-8">
                {{ __('Current season has no tourneys yet.') }}
            </div>
        @endif
        <div class="mt-8">
            <x-link href="{{ route('tourneys.archive') }}" class="text-sm">{{ __('Tourney archive') }}</x-link>
        </div>
    </div>
</x-layouts.front>
