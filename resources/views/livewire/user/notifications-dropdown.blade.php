<div>
    <x-dropdown alignment="right" width="wider">
        <x-slot name="trigger">
            <div class="relative">
                <div
                    class="absolute font-semibold text-xs text-gray-800 flex items-center justify-center w-4 h-4 rounded-full bg-clip-padding border-2 border-yellow-300 bg-yellow-400 -right-0.5 -top-1">
                    {{ $unreadNotifications->count() < 10 ? $unreadNotifications->count() : '9+' }}
                </div>
                <svg class="h-8 w-8 text-gray-300 hover:text-gray-200 transition" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
        </x-slot>
        @foreach($unreadNotifications as $notification)
            @if($loop->index < 9)
                <button
                    class="w-full text-left text-sm text-blue-200 hover:bg-gray-700 hover:text-blue-100 px-4 py-2"
                    wire:click="markAsRead('{{ $notification->id }}')"
                >
                    @if($notification->type == 'App\Notifications\PostWasPublished')
                        <span class="font-semibold">{{ $notification->data['author'] }}</span>
                        {{ __('published') }}
                        <br>
                        {{ Str::words($notification->data['title'], 10) }}
                        <br>

                    @elseif($notification->type == 'App\Notifications\TourneyWasCreated')
                        {{ __('New tourney') }}
                        <span class="text-sm font-semibold block">{{ $notification->data['at'] }}</span>
                    @elseif($notification->type == 'App\Notifications\CompetitionWasCreated')
                        {{ __('New competition') }}
                        <span class="block">{{ __('Ends at:') }} {{ $notification->data['ends_at'] }}</span>
                    @else
                        Unknown notification
                    @endif
                    <span
                        class="block text-xs text-right text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</span>
                </button>
                @if(!$loop->last)
                    <div class="border-t border-gray-500"></div>
                @endif
            @else
                <a
                    href="{{ route('notifications.index') }}"
                    class="block w-full font-semibold text-center text-sm text-blue-200 hover:bg-gray-700 hover:text-blue-100 px-4 py-2"
                >
                    {{ __('All notifications') }}
                </a>
                @break
            @endif
        @endforeach
    </x-dropdown>
</div>
