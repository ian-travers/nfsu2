<div x-data="{ open: @entangle('isShow') }">
    <div
        style="display: none"
        x-show.transition.duration.800ms="open"
        class="bg-transparent border border-gray-100 px-8 py-4 my-4"
    >
        <div class="flex items-center justify-between">
            <div class="text-gray-50 tracking-wider font-extralight">Server data search result</div>
            <div
                @click="open = false"
                class="px-2 py-2 cursor-pointer"
            >
                <svg class="fill-current text-gray-100" fill="currentColor" width="18" height="18"
                     viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
            </div>
        </div>
        @empty($playerInfo)
            <div class="mt-3">
                {!! __('There is no information about player with username <strong>:name</strong>', ['name' => $playerName]) !!}
            </div>
        @else
            <div
                class="text-center text-3xl font-light tracking-widest mb-3"
            >
                {{ $playerName }}
            </div>
            <table class="border border-blue-400 divide-y divide-blue-200 w-full mb-3">
                <thead>
                <tr class="text-center divide-x divide-blue-400">
                    <th class="text-center w-1/3 sm:w-1/6"></th>
                    <th class="text-center w-1/3 sm:w-1/6">{{ __('Overall') }}</th>
                    <th class="text-center w-1/3 sm:w-1/6">{{ __('Circuit') }}</th>
                    <th class="text-center hidden sm:table-cell w-1/6">{{ __('Sprint') }}</th>
                    <th class="text-center hidden sm:table-cell w-1/6">{{ __('Drag') }}</th>
                    <th class="text-center hidden sm:table-cell w-1/6">{{ __('Drift') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-blue-400">
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center px-3 py-1">{{ __('Rating') }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['overall']['rating'] }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['circuit']['rating'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['sprint']['rating'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drag']['rating'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drift']['rating'] }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">REP</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['REP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['REP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['REP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['REP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['REP'], 0, '', ' ') }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Wins') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['wins'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['wins'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['wins'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['wins'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['wins'], 0, '', ' ') }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Loses') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['loses'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['loses'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['loses'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['loses'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['loses'], 0, '', ' ') }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Wins %') }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['overall']['winsPercent'] }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['circuit']['winsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['sprint']['winsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drag']['winsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drift']['winsPercent'] }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Disconnects') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['disconnects'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['disconnects'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['disconnects'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['disconnects'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['disconnects'], 0, '', ' ') }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Disconnects %') }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['overall']['disconnectsPercent'] }}</td>
                    <td class="px-3 py-1">{{ $playerInfo['circuit']['disconnectsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['sprint']['disconnectsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drag']['disconnectsPercent'] }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ $playerInfo['drift']['disconnectsPercent'] }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Avg.Opps.Rank') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['avgOppRating'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['avgOppRating'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['avgOppRating'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['avgOppRating'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['avgOppRating'], 0, '', ' ') }}</td>
                </tr>
                <tr class="text-right divide-x divide-blue-400">
                    <td class="text-center">{{ __('Avg.Opps.REP') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['overall']['avgOppREP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1">{{ number_format($playerInfo['circuit']['avgOppREP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['sprint']['avgOppREP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drag']['avgOppREP'], 0, '', ' ') }}</td>
                    <td class="px-3 py-1 hidden sm:table-cell">{{ number_format($playerInfo['drift']['avgOppREP'], 0, '', ' ') }}</td>
                </tr>
                </tbody>
            </table>
        @endempty
    </div>
</div>

