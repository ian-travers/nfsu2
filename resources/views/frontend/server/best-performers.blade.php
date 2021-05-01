<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-full">
        {{-- Nav --}}
        <nav class="-ml-3 flex space-x-1 sm:space-x-8" aria-label="Tabs">
            @foreach($modes as $name => $tracks)
                <x-dropdown>
                    <x-slot name="trigger">
                        <button
                            class="{{ $type == $name ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                            {{ $type == $name ? 'aria-current="page"' : '' }}
                        >
                            {{ __($name) }}
                            <svg class="h-5 w-5 text-gray-400 ml-0.5 inline-flex" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    @foreach($tracks as $key => $trackName)
                        <x-dropdown-link
                            href="{{ route('server.best-performers', [strtolower($name), $key]) }}"
                        >
                            {{ $trackName }}
                        </x-dropdown-link>
                    @endforeach
                </x-dropdown>
            @endforeach
        </nav>{{-- End Nav --}}

        <h2 class="mt-4 text-3xl text-center tracking-wide">{{ $track }}</h2>

        @if($rating->count())
            <div class="mt-2 sm:mt-4">
                <table class="border border-blue-400 divide-y divide-blue-200 w-full">
                    <thead>
                    <tr class="text-center divide-x divide-blue-400">
                        <th class="py-2 px-4 w-1/12">{{ __('Rating') }}</th>
                        <th class="py-2 px-4">{{ __('Player') }}</th>
                        <th class="py-2 px-4 w-1/5">{{ $type == 'Drift' ? __('Score') : __('Time') }}</th>
                        <th class="py-2 px-4 w-1/5">{{ __('Car') }}</th>
                        <th class="py-2 px-4 w-1/5">{{ __('Direction') }}</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-400">
                    @foreach($rating as $player)
                        <tr class="divide-x divide-blue-400">
                            <td class="py-1 px-3 text-center">{{ $loop->index + 1 }}</td>
                            <td class="py-1 px-3">{{ $player['name'] }}</td>
                            <td class="py-1 px-3 text-right">{{ $player['resultForHumans'] }}</td>
                            <td class="py-1 px-3">{{ $player['car'] }}</td>
                            <td class="py-1 px-3">{{ $player['direction'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-xl">{{ __('The rating on this track is empty.') }}</div>
        @endif

    </div>
</x-layouts.front>
