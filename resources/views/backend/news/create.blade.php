<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Create news item') }}</h1>
        <a href="{{ route('adm.news.index') }}">
            <x-form.primary-button>{{ __('All news') }}</x-form.primary-button>
        </a>
    </div>
    <form action="{{ route('adm.news.store') }}" method="post" class="mt-4">
        @csrf
        @include('backend.news._form')

        <div class="mt-6">
            <x-form.primary-button type="submit">{{ __('Create') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>

