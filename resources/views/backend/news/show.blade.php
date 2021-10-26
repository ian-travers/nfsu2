<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('View news item') }}</h1>
        <a href="{{ route('adm.news.index') }}">
            <x-form.primary-button>{{ __('All news') }}</x-form.primary-button>
        </a>
    </div>
    <x-backend.form-panel class="px-4 py-8 mt-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div class="text-xl font-semibold">
                {{ $newsitem->title_en }}
            </div>
            <div class="text-xl font-semibold">
                {{ $newsitem->title_ru }}
            </div>
            <div>
                {{ $newsitem->body_en }}
            </div>
            <div>
                {{ $newsitem->body_ru }}
            </div>
        </div>
    </x-backend.form-panel>
    <x-backend.form-panel class="px-4 py-4 my-4">
        <div class="text-lg">{{ __('Comments') }}</div>
        @if($newsitem->comments->count())
            <div class="mt-4">
                @include('backend.comments._table', ['comments' => $newsitem->comments])
            </div>
        @else
            <p class="mt-4">
                {{ __('There is no comments yet.') }}
            </p>
        @endif
    </x-backend.form-panel>
</x-layouts.back>
