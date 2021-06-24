<x-layouts.front title="{{ $title }}">
    <div class="px-4 md:px8 mt-2 md:mt-4">
        <div class="flex flex-col sm:flex-row mt-2 md:mt-6">
            <div class="w-full sm:w-56 lg:w-72 px-4 py-1">
                <x-user-cabinet.nav></x-user-cabinet.nav>
            </div>
            <div class="flex-1 py-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layouts.front>
