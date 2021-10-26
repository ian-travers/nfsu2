<x-layouts.back title="{{ $title }}">
    <div class="relative inline-flex">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Comments') }}</h1>
        <p class="absolute rounded-md text-xs text-gray-50 bg-yellow-500 transform -rotate-12 -top-1 -right-8 px-1 py-0.5">raw</p>
    </div>

    @if($comments->count())
        <div class="mt-4">
            @include('backend.comments._table')

            <div class="my-4">
                {{ $comments->links() }}
            </div>
        </div>
    @else
        <p class="mt-4">
            {{ __('There is no comments yet.') }}
        </p>
    @endif
</x-layouts.back>
