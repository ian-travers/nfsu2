<x-layouts.back title="{{ $title }}">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Applications settings') }}</h1>
    </div>
    <div class="grid md:grid-cols-3 lg:grid-cols-3 gap-4">
        @livewire('dashboard.dashboard-racer-test')
    </div>
</x-layouts.back>
