<p class="block mb-1 ml-2">{{ __('Type') }}</p>
<x-dropdown>
    <x-slot name="trigger">
        <button
            class="flex items-center justify-between bg-transparent font-medium rounded-md w-full text-left border border-blue-400 hover:border-blue-300 focus:border-blue-300 px-3 py-2"
        >
            {{ request('type') !== null ? ucfirst(request('type')) : __('Overall') }}
            <svg class="h-5 w-5 ml-0.5 inline-flex" viewBox="0 0 20 20"
                 fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </x-slot>
    @foreach($types as $type)
        <x-dropdown-link
            href="{{ $type == 'overall'
                                ? $route . '/?' . http_build_query(request()->except('type'))
                                : $route . '/?type=' . $type . '&' .http_build_query(request()->except('type'))
                            }}"
        >
            {{ __(ucfirst($type)) }}
        </x-dropdown-link>
    @endforeach
</x-dropdown>
