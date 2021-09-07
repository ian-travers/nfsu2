<x-layouts.front>
    <div class="max-w-screen-xl mx-auto py-6">
        <div>
            I'm here
        </div>
        <div>
            Здесь ща
        </div>
        @auth
            <div class="text-2xl">
                You are logged in now
            </div>
        @endauth
    </div>
    <div class="flex items-center mt-6">
        <x-season-award place="1" type="competition" size="40"/>
        <x-season-award place="2" type="competition" size="40"/>
        <x-season-award place="3" type="competition" size="40"/>
        <x-tourney-medal place="1" type="drift" size="40"/>
        <x-tourney-medal place="2" type="drift" size="40"/>
        <x-tourney-medal place="3" type="drift" size="40"/>
    </div>
</x-layouts.front>
