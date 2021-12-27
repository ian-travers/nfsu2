@php
    if (auth()->check()) {
        app()->setLocale(auth()->user()->locale);
    }
@endphp

<x-layouts.error title="{{ __('Forbidden') }}">
    <div class="text-center text-yellow-500">
        <p class="font-semibold uppercase tracking-wide">{{ __('403 error') }}</p>
        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight mt-2">{{ __('Forbidden') }}.</h1>
        <p class="text-lg sm:text-xl mt-2">{{ __("You don't have the authority to the requested resource.") }}</p>
        <div class="mt-6">
            <x-link href="{{ route('home') }}">
                {{ __('Go back home') }}
                <span aria-hidden="true"> &rarr;</span>
            </x-link>
        </div>
    </div>
</x-layouts.error>
