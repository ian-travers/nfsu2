@php /** @var \App\Models\Quiz\Question $question */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('New quiz answer') }}</h1>
        <a href="{{ route('adm.quiz.question.show', $question) }}">
            <x-form.primary-button>{{ __('View quiz question') }}</x-form.primary-button>
        </a>
    </div>

    <div class="text-lg">{{ $question->question }}</div>

    <form action="{{ route('adm.quiz.answers.store', $question) }}" method="post" class="mt-4">
        @csrf
        @include('backend.quiz.answers._form')

        <div class="mt-3">
            <x-form.primary-button type="submit">{{ __('Create') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>
