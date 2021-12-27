<x-layouts.error title="{{ __('Page expired') }}">
    <div class="text-center text-yellow-500">
        <p class="font-semibold uppercase tracking-wide">{{ __('419 error') }}</p>
        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight mt-2">{{ __('Page expired') }}.</h1>
        <p class="text-lg sm:text-xl mt-2">{{ __("While you were sleeping, doing something somewhere or leaving for a long time, this page has become outdated.") }}</p>
        <div class="mt-6">
            <x-link href="{{ route('home') }}">
                {{ __('Go back home') }}
                <span aria-hidden="true"> &rarr;</span>
            </x-link>
        </div>
    </div>
</x-layouts.error>
