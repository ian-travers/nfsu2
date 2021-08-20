<div
    {{ $attributes }}
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    @keydown.escape.window="show = false"
    style="display: none"
>
    <div class="fixed inset-0 bg-gray-900 opacity-60"></div>

    <div
        class="bg-gray-50 max-w-md h-60 mt-12 mx-auto rounded-md border border-gray-400 fixed inset-0"
        @click.away="show = false"
        x-show.transition="show"
    >
        <div class="flex flex-col h-full justify-between">
            <header class="flex justify-between items-center px-6 py-4">
                <p class="text-2xl">{{ $title }}</p>
                <div
                    class="cursor-pointer z-50"
                    @click="show = false"
                >
                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </header>
            <main class="mb-4 px-6">
                {{ $slot }}
            </main>
            <footer
                class="flex justify-end border-t border-gray-400 border-opacity-50 space-x-2 rounded-b-md px-6 py-4">
                {{ $footer }}
            </footer>
        </div>
    </div>
</div>

