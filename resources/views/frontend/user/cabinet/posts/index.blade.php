<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your posts') }}</h1>
                <a href="{{ route('cabinet.posts.create') }}">
                    <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
                </a>
            </div>

            @if($posts->count())
                <div class="mt-4">
                    @include('frontend.user.cabinet.posts._table')

                    <div class="my-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            @else
                <p class="mt-4">
                    {{ __('There is no posts yet.') }}
                </p>
            @endif
        </div>
    </div>
</x-layouts.cabinet>
