<div class="flex rounded-md">
    <label for="player" class="sr-only">Search</label>
    <input
        wire:model.lazy="player"
        wire:keydown.enter="search"
        wire:keydown.tab="search"
        type="text"
        name="player"
        id="player"
        class="block w-full rounded-none rounded-l-md pl-4 sm:text-sm border border-blue-400 bg-transparent focus:bg-transparent"
        placeholder="{{ __('Player name...') }}"
    >
    <button
        wire:click="search"
        class="-ml-px relative inline-flex px-4 py-2 border border-blue-400 hover:border-blue-200 text-sm font-medium rounded-r-md bg-transparent focus:outline-none focus:ring-1 focus:ring-blue-200 focus:border-blue-500"
    >
        <svg class="flex-shrink-0 h-5 w-5 text-blue-200" viewBox="0 0 20 20" fill="currentColor"
             aria-hidden="true">
            <path fill-rule="evenodd"
                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                  clip-rule="evenodd"/>
        </svg>
    </button>
</div>


