<div
    x-data="{ isOpen: false }"
    @click.away="isOpen = false"
    class="md:hidden mr-3 my-1"
>
    <div class="flex items-center justify-between px-4">
        {{-- Logo--}}
        <a href="{{ route('home') }}">
            <x-logo></x-logo>
        </a>
        <div class="flex items-center">
            {{-- Mobile menu toggle button --}}
            <button
                @click="isOpen = !isOpen"
                class="bg-nfsu-color inline-flex items-center justify-center p-2 rounded-md border border-gray-700 text-blue-200 hover:text-blue-100 hover:bg-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg x-show="!isOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="isOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button> {{-- End menu toggle button --}}
            <x-language-switcher class="ml-3"></x-language-switcher>
        </div>

    </div>
    {{-- Menu items--}}
    <div
        style="display: none"
        x-show="isOpen"
        class="md:hidden border-t border-gray-600 mt-1"
    >
        <div class="px-2 py-3 ">
            <x-navs.mobile-link route="#">{{ __('Tourneys') }}</x-navs.mobile-link>
            <div class="text-sm font-semibold text-gray-400 tracking-widest uppercase text-center">
                {{ __('Game Server') }}
            </div>
            <x-navs.mobile-link route="server.monitor">{{ __('Monitor') }}</x-navs.mobile-link>
            <x-navs.mobile-link route="server.best-performers-redirect">{{ __('Best Performers') }}</x-navs.mobile-link>
            <x-navs.mobile-link route="server.ratings-redirect">{{ __('Ratings') }}</x-navs.mobile-link>

        </div>
        <div class="pt-4 pb-3 border-t border-gray-700">
            @auth
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        @livewire('user.avatar')
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">{{ auth()->user()->username }}</div>
                        <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                    <button
                        class="ml-auto bg-nfsu-brand flex-shrink-0 p-1 text-gray-400 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <x-navs.mobile-link route="settings.profile">{{ __('Settings') }}</x-navs.mobile-link>
                    <form method="post" id="logout-form-mobile" action="{{ route('logout') }}">
                        @csrf
                        <x-navs.mobile-link
                            route="logout"
                            onclick="event.preventDefault(); document.querySelector('#logout-form-mobile').submit();"
                        >
                            {{ __('Logout') }}
                        </x-navs.mobile-link>
                    </form>
                </div>
            @endauth
            @guest
                <x-navs.mobile-link route="login">{{ __('Login') }}</x-navs.mobile-link>
                <x-navs.mobile-link route="register">{{ __('Register') }}</x-navs.mobile-link>
            @endguest
        </div>
    </div>
</div>
