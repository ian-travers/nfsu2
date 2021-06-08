<x-layouts.front title="{{ $title }}">
    <div class="flex bg-gray-100 text-gray-900">
        <div class="flex w-48 md:w-64">
            <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 pb-4 bg-white px-1 md:px-2">
                <div class="flex-grow flex flex-col">
                    <x-navs.backend-nav></x-navs.backend-nav>
                </div>
            </div>
        </div>
        <div class="flex-grow px-2 md:px-4 my-2 md:my-4">
            {{ $slot }}
        </div>
    </div>
</x-layouts.front>
