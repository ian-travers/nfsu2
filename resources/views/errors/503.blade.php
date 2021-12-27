<x-layouts.error title="{{ __('Service unavailable') }}">
    <div class="text-center text-yellow-500">
        <p class="font-semibold uppercase tracking-wide">{{ __('503 error') }}</p>
        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight mt-2">{{ __('Service unavailable') }}.</h1>
        <p class="text-lg sm:text-xl mt-2">{{ __("Sorry, the server is not temporarily processing your requests. You  caught me up when the site is under maintenance. Most likely it will not drag out for a long time.") }}</p>
    </div>
</x-layouts.error>
