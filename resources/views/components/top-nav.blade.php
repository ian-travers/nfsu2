<nav class="max-w-screen-2xl mx-auto px-8">
    <div class="flex items-center justify-between h-16">
        {{-- Left part of a menu --}}
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <div class="flex items-center w-60">
                    <img class="w-20 mr-1 md:w-24 md:mr-2" src="{{ asset('storage/logo.png') }}"
                         alt="Logo">
                    <span class="text-blue-200 hover:text-blue-100 text-lg md:text-2xl mb-0.5">NFSU Cup</span>
                </div>
            </a>
            <div class="flex items-baseline space-x-2">
                <x-navs.link route="#">{{ __('Tourneys') }}</x-navs.link>
                <x-navs.link route="#">{{ __('Game Server') }}</x-navs.link>
            </div>
        </div> {{-- End of the left part --}}

        {{-- Right part of a menu --}}
        <div class="flex items-center">
            @guest
                <x-navs.link route="login">{{ __('Login') }}</x-navs.link>
                <x-navs.link route="register">{{ __('Register') }}</x-navs.link>
            @endguest
        </div> {{-- End of the left part --}}
    </div>
</nav>
