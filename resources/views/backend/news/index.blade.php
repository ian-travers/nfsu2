<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('News') }}</h1>
        <a href="{{ route('adm.news.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>

    @if($news->count())
        <div class="mt-4">
            @include('backend.news._table')

            <div class="my-4">
                {{ $news->links() }}
            </div>
        </div>
    @else
        <p class="mt-4">
            {{ __('There is no news yet.') }}
        </p>
    @endif
</x-layouts.back>

