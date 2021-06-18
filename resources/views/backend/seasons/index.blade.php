<x-layouts.back title="{{ $title }}">
    <h1 class="text-2xl font-semibold tracking-wide">{{ __('Users') }}</h1>

    <div class="mt-4">
        @include('backend.seasons._table')
    </div>
</x-layouts.back>
