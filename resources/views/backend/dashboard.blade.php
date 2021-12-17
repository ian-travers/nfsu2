<x-layouts.back title="{{ $title }}">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Application settings') }}</h1>
    </div>
    <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-4">
        @livewire('dashboard.dashboard-season')
        @livewire('dashboard.dashboard-racer-test')
        @livewire('dashboard.dashboard-scoring')
        <div class="lg:col-span-2 xl:col-span-3">
            @livewire('dashboard.dashboard-site-points')
        </div>
    </div>
</x-layouts.back>
