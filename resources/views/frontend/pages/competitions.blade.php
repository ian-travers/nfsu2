<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('About Competitions') }}</h2>
        <div class="space-y-6">
            <p class="text-base">
                {{ __('A competition is a specific, mostly correspondence contest.') }}
                {{ __('The section indicates from 1 to 4 tracks on which the competition takes place.') }}
                {{ __('Further, real simple.') }}
                {{ __('All that is required of you is to get into the Best Performers on these tracks.') }}
                {{ __('The competition rating includes only registered users.') }}
            </p>
            <p class="text-base">
                {{ __('The competition usually lasts about a week.') }}
                {{ __('At the end of the competition, the winners receive trophies.') }}
            </p>
        </div>
    </div>
</x-layouts.front>
