<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('About Tourneys') }}</h2>
        <div class="space-y-6">
            <p class="text-base">
                {{ __("Tourneys are a significant part of the NFSU Cup project.") }}
                {{ __("Series of tourneys are divided into seasons. Typically, a season consists of about 60 tourneys.") }}
                {{ __("There are ratings in a season (personal, country, team).") }}
                {{ __("Winners receive rewards at the end of the season.") }}
                {{ __("There are five nominations. Main is 'Overall' and of each types: Circuit, Sprint, Drag, Drift.") }}
            </p>
            <p class="text-base">
                {{ __("Only registered users with the 'racer' status can take part in tourneys.") }}
                {{ __("To obtain this status, you need to study the rules and pass the test.") }}
            </p>
            <p class="text-base">
                {{ __("The NFSU Cup tourneys are based on the idea invented by the USSR Team players in 2004 and the races held on the official EA server in 2004-2006.") }}
            </p>
        </div>
    </div>
</x-layouts.front>
