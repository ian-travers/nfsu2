<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Blog posts') }}</h1>
        <a href="{{ route('adm.posts.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>

    @if($posts->count())
        <div class="mt-4">
            @include('backend.posts._table')

            <div class="my-4">
                {{ $posts->links() }}
            </div>
        </div>
    @else
        <p class="mt-4">
            {{ __('There is no posts yet.') }}
        </p>
    @endif
</x-layouts.back>
