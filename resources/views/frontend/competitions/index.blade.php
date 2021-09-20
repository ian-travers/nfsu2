<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Current competition') }}</h2>
        <x-competitions.active-card :competition="$competition"/>

        <div class="mt-8">
            <x-link href="{{ route('competitions.archive') }}" class="text-sm">{{ __('Competition archive') }}</x-link>
        </div>
    </div>
</x-layouts.front>
