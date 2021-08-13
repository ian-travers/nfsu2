<div class="hidden md:flex items-center justify-between h-16 flex-1 px-2 sm:px-4 md:px-6">
    {{-- Left part of a menu --}}
    <div class="flex items-center space-x-2">
        {{-- Logo--}}
        <a href="{{ route('home') }}">
            <x-logo></x-logo>
        </a>
        <x-navs.link route="tourneys.index">{{ __('Tourneys') }}</x-navs.link>

        <x-dropdown>
            <x-slot name="trigger">
                <button
                    class="hover:bg-gray-700 hover:text-blue-100 px-3 py-2 rounded-md font-medium {{ substr(Route::currentRouteName(), 0, 9) == 'standings' ? 'bg-gray-900 text-white' : 'text-blue-200' }}"
                >
                    {{ __('Season standings') }}
                </button>
            </x-slot>
            <x-dropdown-link href="{{ route('season-standings.personal') }}">{{ __('Personal standing') }}</x-dropdown-link>
            <x-dropdown-link href="{{ route('season-standings.countries') }}">{{ __('Countries standing') }}</x-dropdown-link>
            <x-dropdown-link href="{{ route('season-standings.teams') }}">{{ __('Teams standing') }}</x-dropdown-link>
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
            <x-dropdown alignment="right">
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
