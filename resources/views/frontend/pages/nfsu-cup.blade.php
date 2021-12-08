<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('About NFSU Cup') }}</h2>
        <div class="space-y-6">
            <p class="text-base">
                {{ __('Many years have passed since the release of the game Need for Speed Underground.') }}
                {{ __('It happened at the end of 2003.') }}
                {{ __('All the advantages of this game will not be listed here.') }}
                {{ __('It seems that you already know them.') }}
                {{ __('In any case, this information is easy to find on the net.') }}
            </p>
            <p class="text-base">
                {{ __('The atmosphere of the game and the soundtrack and customization of the vehicles made a strong impression.') }}
                {{ __('This, as they say, did not go unnoticed.') }}
                {{ __('The game has a huge number of fans and many thousands of them went online.') }}
                {{ __('So it was in 2004. It was impossible to enter the room. There were no places.') }}
                {{ __('The world does not stand still. Like everything that was popular, it loses its popularity over time.') }}
                {{ __('Omitting details in 2007, EA show down services for online playing.') }}
            </p>
            <p class="text-base">
                {{ __('NFSU Cup is a project designed for online races on Need for Speed Underground.') }}
                {{ __('Our mission is to unite all fans of this game.') }}
            </p>
            <p class="text-base">
                {{ __('Join to NFSU Cup.') }}
            </p>
        </div>

        <div class="mt-10 pb-12 sm:pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <dl class="space-y-4 sm:space-y-0 sm:grid sm:grid-cols-4 sm:gap-6 spa">
                        <div
                            class="flex flex-col p-6 text-center bg-gray-800 bg-opacity-50 rounded-xl border border-blue-400 transform hover:scale-105 duration-300">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium">
                                {{ __('Racers') }}
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-green-400">
                                {{ \App\Models\User::racer()->count() }}
                            </dd>
                        </div>
                        <div
                            class="flex flex-col p-6 text-center bg-gray-800 bg-opacity-50 rounded-xl border border-blue-400 transform hover:scale-105 duration-300">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium">
                                {{ __('Tourneys') }}
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-green-400">
                                {{ \App\Models\Tourney\Tourney::count() }}
                            </dd>
                        </div>
                        <div
                            class="flex flex-col p-6 text-center bg-gray-800 bg-opacity-50 rounded-xl border border-blue-400 transform hover:scale-105 duration-300">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium">
                                {{ __('Teams') }}
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-green-400">
                                {{ \App\Models\Team::count() }}
                            </dd>
                        </div>
                        <div
                            class="flex flex-col p-6 text-center bg-gray-800 bg-opacity-50 rounded-xl border border-blue-400 transform hover:scale-105 duration-300">
                            <dt class="order-2 mt-2 text-lg leading-6 font-medium">
                                {{ __('Countries') }}
                            </dt>
                            <dd class="order-1 text-5xl font-extrabold text-green-400">
                                {{ \App\Models\User::distinct()->count('country') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-layouts.front>
