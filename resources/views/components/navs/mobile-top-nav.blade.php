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
            <x-language-switcher></x-language-switcher>
        </div>

    </div>
    {{-- Menu items--}}
    <div
        style="display: none"
        x-show="isOpen"
        class=" border-b border-gray-700 bg-nfsu-color md:hidden"
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
        <div class="px-2 py-3 space-y-1 border-t border-gray-700">
            @guest
                <x-navs.mobile-link route="#">{{ __('Login') }}</x-navs.mobile-link>
                <x-navs.mobile-link route="register">{{ __('Register') }}</x-navs.mobile-link>
            @endguest
        </div>
    </div>
</div>
