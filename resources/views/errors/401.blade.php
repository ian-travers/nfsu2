<x-layouts.error title="{{ __('Unauthorized') }}">
    <div class="text-center text-yellow-500">
        <p class="font-semibold uppercase tracking-wide">{{ __('401 error') }}</p>
        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight mt-2">{{ __('Unauthorized') }}.</h1>
        <p class="text-lg sm:text-xl mt-2">{{ __("You requested something tricky, but you're not logged in properly.") }}</p>
        <div class="mt-6">
            <x-link href="{{ route('home') }}">
                {{ __('Go back home') }}
                <span aria-hidden="true"> &rarr;</span>
            </x-link>
        </div>
    </div>
</x-layouts.error>
