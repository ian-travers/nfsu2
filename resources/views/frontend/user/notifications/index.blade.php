<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Your notifications') }}</h2>
        @if($notifications->count())
            <div class="mt-4">
                @include('frontend.user.notifications._table')

                <div class="my-4">
                    {{ $notifications->links() }}
                </div>
            </div>
        @else
            <p class="mt-4">
                {{ __('You have no notifications.') }}
            </p>
        @endif
    </div>
</x-layouts.front>
