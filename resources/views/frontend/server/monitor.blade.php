@php /** @var App\Models\NFSUServer\RealServer $serverInfo */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-2 md:px-8 text-blue-400 max-w-full">
        @if($serverInfo->isOnline())
            <div class="block text-center md:flex md:items-center md:justify-between mb-4">
                <div class="mb-4 md:mb-0">
                    <span class="mr-3">{{ __('Players') }}:</span>
                    <span class="mr-1">{{ __('Online') }}</span>
                    <span
                        class="px-2 py-1 rounded text-gray-50 bg-blue-500 mr-4">{{ $serverInfo->playersCount() }}</span>
                    <span class="mr-1">{{ __('In races') }}</span>
                    <span class="px-2 py-1 rounded text-gray-50 bg-blue-500">{{ $serverInfo->playersInRaces() }}</span>
                </div>
                <div>
                   <span class="mr-5">{{ __('TJ guard') }} {!!
                    $serverInfo->isBanCheaters()
                        ? '<span class="ml-1 px-2 py-1 rounded text-gray-50 bg-red-600">' . __('On') . '</span>'
                        : '<span class="ml-1 px-2 py-1 rounded text-gray-50 bg-green-600">' . __('Off') . '</span>'
                !!}</span>
                    {{ __('Rooms guard') }} {!!
                    $serverInfo->isBanNewRooms()
                        ? '<span class="ml-1 px-2 py-1 rounded text-gray-50 bg-red-600">' . __('On') . '</span>'
                        : '<span class="ml-1 px-2 py-1 rounded text-gray-50 bg-green-600">' . __('Off') . '</span>'
                 !!}
                </div>

            </div>
            <div class="text-center uppercase text-4xl font-black tracking-widest mb-4">Ranked game</div>
            <div class="grid gap-4 md:gap-8 grid-cols-2 md:grid-cols-4">
                <div>
                    <p class="text-center text-2xl tracking-wider">Circuit</p>
                    <x-rooms-table :rooms="$serverInfo->roomsCircuitRanked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Sprint</p>
                    <x-rooms-table :rooms="$serverInfo->roomsSprintRanked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Drift</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDriftRanked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Drag</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDragRanked()"/>
                </div>
            </div>
            <div class="text-center uppercase text-4xl font-black tracking-widest mb-4 mt-14">Unranked game</div>
            <div class="grid gap-4 md:gap-8 grid-cols-2 md:grid-cols-4">
                <div>
                    <p class="text-center text-2xl tracking-wider">Circuit</p>
                    <x-rooms-table :rooms="$serverInfo->roomsCircuitUnranked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Sprint</p>
                    <x-rooms-table :rooms="$serverInfo->roomsSprintUnranked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Drift</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDriftUnranked()"/>
                </div>
                <div>
                    <p class="text-center text-2xl tracking-wider">Drag</p>
                    <x-rooms-table :rooms="$serverInfo->roomsDragUnranked()"/>
                </div>
            </div>

            <div class="flex justify-end mt-4 md:mt-8">
                <p class="text-xs">
                    <strong>{{ $serverInfo->name() }}</strong>
                    (version: {{ $serverInfo->version() }} |
                    platform: {{ $serverInfo->platform() }} |
                    IP: {{ $serverInfo->ip() }})
                    {{ $serverInfo->onlineTimeForHumans() }}
                </p>
            </div>
        @else
            <div class="text-center mt-8">
                <p class="text-5xl text-red-300">{{ __('Server is offline') }}</p>
                <p class="text-2xl mt-3">{{ __('Check back later') }}</p>
                <span class="text-sm">IP: {{ $serverInfo->ip() }}</span>
            </div>
        @endif
    </div>
</x-layouts.front>

