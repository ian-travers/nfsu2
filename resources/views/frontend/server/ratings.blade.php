<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-full">
        <div class="text-center sm:flex items-center justify-between">
            {{-- nav --}}
            <nav class="flex space-x-0 sm:space-x-4" aria-label="Tabs">
                {{-- Current: "bg-blue-100 text-gray-90", Default: "text-blue-300 hover:text-blue-200" --}}
                <a
                    href="{{ route('server.ratings', 'overall') }}"
                    class="{{ $type == 'Overall' ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                    {{ $type == 'Overall' ? 'aria-current="page"' : '' }}
                >
                    {{ __('Overall') }}
                </a>
                <a
                    href="{{ route('server.ratings', 'circuit') }}"
                    class="{{ $type == 'Circuit' ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                    {{ $type == 'Circuit' ? 'aria-current="page"' : '' }}
                >
                    {{ __('Circuit') }}
                </a>
                <a
                    href="{{ route('server.ratings', 'sprint') }}"
                    class="{{ $type == 'Sprint' ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                    {{ $type == 'Sprint' ? 'aria-current="page"' : '' }}
                >
                    {{ __('Sprint') }}
                </a>
                <a
                    href="{{ route('server.ratings', 'drag') }}"
                    class="{{ $type == 'Drag' ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                    {{ $type == 'Drag' ? 'aria-current="page"' : '' }}
                >
                    {{ __('Drag') }}
                </a>
                <a
                    href="{{ route('server.ratings', 'drift') }}"
                    class="{{ $type == 'Drift' ? 'bg-blue-100 text-gray-900' : 'text-blue-300 hover:text-blue-200' }} px-3 py-2 font-medium rounded-md"
                    {{ $type == 'Drift' ? 'aria-current="page"' : '' }}
                >
                    {{ __('Drift') }}
                </a>
            </nav>
            {{-- search --}}
            <div class="mt-2 sm:mt-0">
                @livewire('search-server-player')
            </div>
        </div>

        @livewire('search-result')

        {{-- Rating table --}}
        <h2 class="text-3xl mt-4 text-center tracking-wider font-medium">{{ __($type) }}</h2>
        <div class="my-2 sm:my-6">
            <table class="border border-blue-400 divide-y divide-blue-200 w-full">
                <thead>
                <tr class="text-center divide-x divide-blue-400">
                    <th class="py-2 px-4 w-1/12">{{ __('Rating') }}</th>
                    <th class="py-2 px-4">{{ __('Player') }}</th>
                    <th class="py-2 px-4 w-1/3 md:w-1/5 xl:w-1/6">REP</th>
                    <th class="py-2 px-4 hidden sm:table-cell w-1/12">{{ __('Wins') }}</th>
                    <th class="py-2 px-4 hidden sm:table-cell w-1/12">{{ __('Loses') }}</th>
                    <th class="py-2 px-4 hidden md:table-cell w-1/12">{{ __('Wins %') }}</th>
                    <th class="py-2 px-4 hidden xl:table-cell w-1/12">{{ __('Avg.Opps.Rank') }}</th>
                    <th class="py-2 px-4 hidden xl:table-cell w-1/12">{{ __('Avg.Opps.REP') }}</th>
                    <th class="py-2 px-4 hidden md:table-cell w-1/12">{{ __('Disconnects') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-blue-400">
                @foreach($ranking as $player)
                    <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
                        <td class="py-1 px-3 text-center">
                            {{ $ranking->firstItem() + $loop->index }}
                        </td>
                        <td class="py-1 px-3">{{ $player['name'] }}</td>
                        <td class="py-1 px-3 text-right">{{ number_format($player['REP'], 0, '', ' ') }}</td>
                        <td class="py-1 px-3 hidden sm:table-cell text-right">{{ number_format($player['wins'], 0, '', ' ') }}</td>
                        <td class="py-1 px-3 hidden sm:table-cell text-right">{{ number_format($player['loses'], 0, '', ' ') }}</td>
                        <td class="py-1 px-3 hidden md:table-cell text-right">{{ $player['winsPercent'] }}</td>
                        <td class="py-1 px-3 hidden xl:table-cell text-right">{{ number_format($player['avgOppRating'], 0, '', ' ') }}</td>
                        <td class="py-1 px-3 hidden xl:table-cell text-right">{{ number_format($player['avgOppREP'], 0, '', ' ') }}</td>
                        <td class="py-1 px-3 hidden md:table-cell text-right">{{ $player['disconnectsPercent'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- pagination--}}
            <div class="mt-2 sm:mt-6">
                {{ $ranking->onEachSide(2)->links('components.pagination') }}
            </div>
        </div>
    </div>
</x-layouts.front>
