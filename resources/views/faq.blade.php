<x-layouts.front>
    <div class="w-full max-w-screen-2xl text-blue-400 mx-auto px-4 xl:px-8">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">
            {{ __('Frequently asked questions on NFSU Cup') }}
        </h2>

        <div class="space-y-6 divide-y divide-blue-400">
            <x-faq-item>
                <x-slot name="question">
                    {{ __('What you need to play online Need for Speed Underground?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        <span>{{ __('To play online you need') }}</span>
                        <span><x-link href="{{ route('downloads', 'nfsu') }}">Need forSpeed Underground</x-link></span>
                        <span>{{ __('game and special') }}</span>
                        <span><x-link href="{{ route('downloads', 'nfsu-client') }}">{{ __('client') }}</x-link>.</span>
                    </p>
                    <p class="mb-4">
                        {{ __("In the client click 'Add server' enter the address nfsu-cup.com or 31.131.19.86. In the list that appears, highlight the line with the desired server. Click 'Use server'. Launch the game. In the game menu, select 'PLAY ONLINE'.") }}
                    </p>
                    <div class="bg-blue-400 rounded-xl -mx-2 xl:-mx-8">
                        <div class="px-2 py-2 xl:px-8 xl:py-4">
                            <p class="text-gray-900 ">
                                {{ __('It is recommended to download the client from this site.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('What version of Windows is suitable for the game?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {{ __('Windows 98, Windows XP, Windows 7, 10 and later are suitable for the game. For an online game — the main thing is the client be able to write information to the hosts file.') }}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('Where are Need for Speed Underground save files located?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __("Game saves are in the folder <strong>NFS Underground</strong>. And this folder is for Windows XP: <strong>c:\Documents and Settings\All users\Application Data</strong>. For Windows 7 and later: <strong>c:\Users\All Users</strong>. Often, Application Data and All Users folders are hidden. To see them you need to run in the explorer 'Service → Folder Settings → View' and set the 'Show hidden files' flag.") !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('Does the Save Patcher see save files?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __('Possible cause — the folder where the save files are located is hidden. How to see hidden files is indicated in previous question.') !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __("When I click 'Use server' an error occurs in the client 'Could not write hosts file. Make sure that...' . What should I do?") }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __("This is usually not a problem in Windows XP. Only starting with Windows 7, where the User Account Control (UAC) appeared, did this become a small problem. The main task is to make the client.exe program modify the hosts file. There are several ways to do this. One of them run the client as administrator. This usually helps. If not, you should configure Windows UAC.") !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('What is a RANKED / UNRANKED game?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __("There are two types of rooms on the game server: RANKED and UNRANKED. Because this version of the server keeps a complete record of player statistics, then all races in the RANKED rooms are persisted in statistics. Races in UNRANKED rooms do not change statistics. The statistics take into account REP points and all sorts of average indicators (average rank and REP of opponents), as well as the number of wins, losses and disconnections. Based on the REP points, a player RANKING is compiled, which can be seen both in the game (in the ONLINE GAME menu, the RANKINGS item) and here on the site. Also, the races in the RANKED rooms get into WEEK'S TOP PERFORMERS (this is in the game) and in Best performers (this is on the site).") !!}
                    </p>
                    <p>
                        {!! __("In the days of EA (usually called the time when the official NFS Underground server was running), UNRANKED rooms were usually used for training or some special events. All the people were in the RANKED. One of the main tasks was to climb up the RANKING chain and get into WEEK'S TOP PERFORMERS. For example, in the days of EA in the Circuit, to get into the first hundred you had to have 10 000 000+ REP (For reference: in the game interface RANKINGS shows only the first hundred players)") !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __("What are rooms on the server? Can I create my own room?") }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __("Room — is a place where online players can chat and create races. On the server 31.131.19.86 there are at least two rooms for each type of race. GLOBAL — for all players. SANDBOX — for newbies. Players can create their own rooms. To do this, press Z in the corresponding game menu (see Gameplay). On the server version 2.5 and higher, a restriction can be set on the players creating their own rooms. You can check on the page Monitor Create rooms option.") !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __("Should I complete underground mode (career) to play online?") }}
                </x-slot>

                <div class="text-base">
                    <p class="flex items-start my-4">
                        {!! __("Yes you should! At least two times!") !!}
                        <span class="ml-4">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </p>
                    <p>
                        {!! __("In fact, completing a career is not necessary, but very desirable. Firstly, it is very interesting and dynamic. Secondly, you can gradually get to know all the tracks. Thirdly, it’s best way to feel the control of the car. In the course of a career, the car will gradually improve, and the speed on the tracks will also gradually increase. Fourth, you will understand how a player receives unique car parts from TJ and you can understand which car is cheating and which is not.") !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('What is a TJ cheat?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __('TJ cheat is a car setting with the wrong quantity or quality of unique parts from TJ. This cheat gives some advantage to the player (if, of course, he can cope with such power). In count — unique TJ parts should be only 3. By quality — refer to rules because cars with a TJ cheat are prohibited in tourneys. You can manipulate with a combination of TJ parts in NFSU Save Patcher.') !!}
                    </p>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {!! __("I enter to the room on the server. I see the players. I can chat. But when I enter to a race and the race is started the connection is interrupted. What can I do?'") !!}
                </x-slot>

                <div class="text-base">
                    <p class="mb-4">
                        {!! __('This is the most difficult situation to solve. Because there can be many reasons. Only one thing they have in common is the root of the problem with the connection. Rather, blocks it.') !!}
                    </p>
                    <p class="mb-4">
                        {!! __('The first thing you can do in this situation. Either disable or make Windows Firewall, all third-party firewalls, and antivirus software exceptions for the game. If this does not help, then most likely the problem is in the router. This is such a device that provides the connection of your computer with the Internet. The so-called port forwarding must be configured on the router.') !!}
                    </p>
                    <p class="mb-4">
                        {!! __('For a normal game over the internet, you need to configure the router and forward the following ports to the IP address of the computer with the game:') !!}
                    </p>
                    <p class="font-semibold">
                        TCP: 10800, 10900-10999
                    </p>
                    <p class="font-semibold mb-4">
                        UDP: 10800, 3658, 3659
                    </p>
                    <div class="bg-yellow-400 rounded-xl -mx-2 xl:-mx-8">
                        <div class="px-2 py-2 xl:px-8 xl:py-4">
                            <p class="text-gray-900 ">
                                {{ __('Attention! You should be aware that communication problems can occur not only on your computer, but also on the computer of the player with whom you are trying to play over the internet.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </x-faq-item>

            <x-faq-item>
                <x-slot name="question">
                    {{ __('Where can I find a racer test?') }}
                </x-slot>

                <div class="text-base">
                    <p class="my-4">
                        {!! __("Racer test is only available for registered users. You can find it in the dropdown menu for your account. After successful completion, that menu item will disappear.") !!}
                    </p>
                </div>
            </x-faq-item>
        </div>
    </div>
</x-layouts.front>
