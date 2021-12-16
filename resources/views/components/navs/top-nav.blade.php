<div class="hidden md:flex items-center justify-between h-16 flex-1 px-2 sm:px-4 md:px-6">
    {{-- Left part of a menu --}}
    <div class="flex items-center space-x-2">
        {{-- Logo--}}
        <a href="{{ route('home') }}">
            <x-logo></x-logo>
        </a>
        <x-navs.link route="competitions.index">{{ __('Competition') }}</x-navs.link>

        <x-navs.link route="tourneys.index">{{ __('Tourneys') }}</x-navs.link>

        <x-dropdown>
            <x-slot name="trigger">
                <button
                    class="hover:bg-gray-700 hover:text-blue-100 px-3 py-2 rounded-md font-medium {{ substr(Route::currentRouteName(), 0, 9) == 'standings' ? 'bg-gray-900 text-white' : 'text-blue-200' }}"
                >
                    {{ __('Season standings') }}
                </button>
            </x-slot>
            <p class="text-center font-semibold text-gray-300 pt-2">{{ __('Tourneys') }}</p>
            <x-dropdown-link
                href="{{ route('season-standings.tourney-personal') }}">{{ __('Personal standing') }}</x-dropdown-link>
            <x-dropdown-link
                href="{{ route('season-standings.tourney-countries') }}">{{ __('Countries standing') }}</x-dropdown-link>
            <x-dropdown-link
                href="{{ route('season-standings.tourney-teams') }}">{{ __('Teams standing') }}</x-dropdown-link>
            <div class="border-t border-gray-500"></div>
            <p class="text-center font-semibold text-gray-300 pt-2">{{ __('Competitions') }}</p>
            <x-dropdown-link
                href="{{ route('season-standings.competition-personal') }}">{{ __('Personal standing') }}</x-dropdown-link>
        </x-dropdown>

        <x-dropdown>
            <x-slot name="trigger">
                <button
                    class="hover:bg-gray-700 hover:text-blue-100 px-3 py-2 rounded-md font-medium {{ substr(Route::currentRouteName(), 0, 6) == 'server' ? 'bg-gray-900 text-white' : 'text-blue-200' }}"
                >
                    {{ __('Game server') }}
                </button>
            </x-slot>
            <x-dropdown-link href="{{ route('server.monitor') }}">{{ __('Monitor') }}</x-dropdown-link>
            <div class="border-t border-gray-500"></div>
            <x-dropdown-link
                href="{{ route('server.best-performers', ['circuit', '1001']) }}">{{ __('Best performers') }}</x-dropdown-link>
            <x-dropdown-link
                href="{{ route('server.ratings', 'overall') }}">{{ __('Ratings') }}</x-dropdown-link>
        </x-dropdown>

        @can('admin')
            <x-navs.link route="adm.dashboard">{{ __('Manage Site') }}</x-navs.link>
        @endcan
    </div> {{-- End of the left part --}}

    {{-- Right part of a menu --}}
    <div class="flex items-center">
        {{-- Authenticated user menu --}}
        @auth

            @if(auth()->user()->hasUnreadMessages())
                <x-link href="{{ route('cabinet.dialogues.index') }}">
                    <div class="relative h-8 w-8">
                        <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <x-radar-ping/>
                    </div>
                </x-link>
            @endif

            <div class="mx-2">
                @if(auth()->user()->unreadNotifications()->count())
                    @livewire('user.notifications-dropdown')
                @else
                    <x-link href="{{ route('notifications.index') }}">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </x-link>
                @endif
            </div>

            <x-dropdown alignment="right" width="narrower">
                <x-slot name="trigger">
                    <button
                        class="bg-gray-800 rounded-full flex items-center focus:outline-none focus:ring-1 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                        id="user-menu"
                        aria-haspopup="true"
                    >
                        <span class="sr-only">Open user menu</span>

                        @livewire('user.avatar', ['size' => 10])

                    </button>
                </x-slot>
                @if(auth()->user()->isUser())
                    <x-dropdown-link href="{{ route('tests.racer.show') }}">{{ __('Racer test') }}</x-dropdown-link>
                @endif
                <x-dropdown-link href="{{ route('settings.profile') }}">{{ __('Settings') }}</x-dropdown-link>
                <x-dropdown-link href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</x-dropdown-link>
                <div class="border-t border-gray-500"></div>
                <form method="post" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.querySelector('#logout-form').submit();"
                    >
                        {{ __('Logout') }}
                    </x-dropdown-link>
                </form>
            </x-dropdown>
        @endauth
        @guest
            <x-navs.link route="login">{{ __('Login') }}</x-navs.link>
            <x-navs.link route="register">{{ __('Register') }}</x-navs.link>
        @endguest
        <div class="ml-3">
            <x-language-switcher></x-language-switcher>
        </div>
    </div> {{-- End of the right part --}}
</div>
