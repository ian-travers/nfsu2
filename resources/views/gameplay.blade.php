<x-layouts.front>
    <div class="w-full max-w-screen-2xl text-blue-400 mx-auto px-4 xl:px-8">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">
            {{ __('Gameplay help on NFSU Cup') }}
        </h2>

        <div class="space-y-4">
            <p>
                {{ __('There is Online Game information.') }}
                <br>
                {{ __('The Underground and Quick race modes are not covered in this article.') }}
            </p>
            <p>
                {{ __('Select in the main menu') }}
                <span class="font-bold">PLAY ONLINE</span>.
                {{ __('Next, create a new one or log into an existing account and select the type of race. At this stage we will stop and continue to consider the next steps.') }}
            </p>
            <p>
                {{ __('1. At this step, you can create your own rooms. There are control buttons on the bottom left of the game interface::') }}
            </p>
            <p class="flex justify-center">
                <img src="{{ asset("storage/images/create-room-btn.png") }}" class="border p-2" width="50%"
                     alt="Create room button">
            </p>
            <p>
                {{ __('You can click on them, or use the keyboard shortcuts.') }}
            </p>
            <p>
                {{ __('2. We went into the room on the server. Let consider now what controls are available in the game interface. In the upper part we can see the following.') }}
            </p>
            <p class="flex justify-center">
                <img src="{{ asset("storage/images/online-room-top-elements.png") }}" class="border p-2" width="50%"
                     alt="Room top elements">
            </p>
            <p>
                {{ __("Yellow controls are marked. 1, 2 — switch between the list of races and the list of players. These elements can be clicked with a mouse, but it's more comfortable to use shortcuts: left and right. 3, 4 — switching the type of information on the players. Shortcuts, (comma) and .(dot).") }}
            </p>
            <p>
                {{ __('On the bottom left are the elements:') }}
            </p>
            <p class="flex justify-center">
                <img src="{{ asset("storage/images/online-room-bottom-elements-head-to-head.png") }}" class="border p-2" width="50%"
                     alt="Bottom elements head to head">
            </p>
            <p>
                {{ __("The yellow circle is the line of the game chat. There you can write your messages. Go to it by clicking on the mouse or by pressing the tab key. Next calls the player's menu (if your entry is current in the list of players, the menu will not open). You can watch the player's statistics there, write a private message and so on.") }}
            </p>

            <div class="bg-yellow-300 rounded-xl -mx-2 -my-2 xl:-mx-8 xl:-my-4">
                <div class="px-2 py-2 xl:px-8 xl:py-4">
                    <p class="text-gray-900 ">
                        {{ __('Never challenge a player. This will cause the game to hang on your computer. If you want to play online, invite the players in the game chat and create a race.') }}
                    </p>
                </div>
            </div>

            <p>
                {{ __('3. If you go to the race list, a new element appears at the bottom:') }}
            </p>
            <p class="flex justify-center">
                <img src="{{ asset("storage/images/online-room-bottom-elements-games-list.png") }}" class="border p-2" width="50%"
                     alt="Bottom elements games list">
            </p>
            <p>
                {{ __('Create Game — it is command that creates a new race. Shortcut key is z. Next in this mode serves to join the created game. A good way is an invitation to race via the game chat. The picture shows how BalTazaZ makes such invitation.') }}
            </p>
            <p>
                {{ __('So, there is how looks like the gameplay for the online game Need for Speed Underground in general.') }}
            </p>
        </div>
    </div>
</x-layouts.front>
