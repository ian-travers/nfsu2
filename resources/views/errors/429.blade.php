<x-layouts.error title="{{ __('Too many requests') }}">
    <div class="text-center text-yellow-500">
        <p class="font-semibold uppercase tracking-wide">{{ __('429 error') }}</p>
        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-extrabold tracking-tight mt-2">{{ __('Too many requests') }}.</h1>
        <p class="text-lg sm:text-xl mt-2">{{ __("Well, what a mess. Who is hindered by this small modest site. Or are you really throwing a lot of queries in a row? Mess.") }}</p>
        <div class="mt-6">
            <x-link href="{{ route('home') }}">
                {{ __('Go back home') }}
                <span aria-hidden="true"> &rarr;</span>
            </x-link>
        </div>
    </div>
</x-layouts.error>
