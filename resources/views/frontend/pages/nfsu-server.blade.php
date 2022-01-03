<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('About NFSU Server') }}</h2>
        <div class="space-y-6">
            <p class="text-base">
                {{ __('As you know, Need for Speed Underground has a multiplayer.') }}
                {{ __('Since 2003 the publisher of the game (Electronic Arts) provided the online service for the multiplayer.') }}
                {{ __('However, already in 2004, an alternative appeared.') }}
                {{ __('One man named 3Priedez created his own version of the server for the NFS Underground.') }}
                {{ __('Thus, the concepts of the official and unofficial server appeared.') }}
            </p>
            <p class="text-base">
                {{ __('After EA shut down its servers in 2007, all those who wanted to drive to the NFS Underground were forced to switch to unofficial servers. A special client is used to connect to unofficial servers. It can be downloaded in the Downloads section.') }}
            </p>
            <p class="text-base">
                {{ __('Server version 2.5 is currently running on the NFSU Cup. The server has been running since June 1, 2013.') }}
                {{ __('This is an updated version of the server from 3Priedez.') }}
                {{ __('Fixed some bugs and added some improvements.') }}
                {{ __('All this was done in order to bring the functionality closer to the official version.') }}
                {{ __('It was almost 100% successful.') }}
            </p>
            <p class="text-base">
                {{ __('To connect to this server you need to use the NFSU client and address "www.nfsu-cup.com" or ":ip".', ['ip' => config('nfsu-server.ip')]) }}
            </p>
        </div>
    </div>
</x-layouts.front>
