<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('New quiz question') }}</h1>
        <a href="{{ route('adm.quiz.question.index') }}">
            <x-form.primary-button>{{ __('All questions') }}</x-form.primary-button>
        </a>
    </div>
    <form action="{{ route('adm.quiz.question.store') }}" method="post" class="mt-4">
        @csrf
        @include('backend.quiz.questions._form')

        <div class="mt-3">
            <x-form.primary-button type="submit">{{ __('Create') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>
