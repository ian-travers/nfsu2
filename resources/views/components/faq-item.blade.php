<div
    x-data="{ isOpen: false }"
    class="mx-auto px-4 sm:px-6 lg:px-8"
>
    <div class="pt-6">
        <div class="text-lg">
            <button
                @click="isOpen = !isOpen"
                type="button"
                class="text-left w-full flex justify-between items-start text-gray-300 hover:text-gray-200"
            >
                <span class="font-medium">
                    {{ $question }}
                </span>
                <span class="ml-6 h-7 flex items-center">
                    <svg
                        class="h-6 w-6 transform duration-150"
                        :class="isOpen ? '-rotate-180' : 'rotate-0'"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"/>
                    </svg>
                </span>
            </button>
        </div>
        <div
            style="display: none"
            x-show="isOpen"
            class="mt-4 pr-12"
            x-transition:enter="transition ease-out duration-150 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >

            {{ $slot }}
        </div>
    </div>
</div>
