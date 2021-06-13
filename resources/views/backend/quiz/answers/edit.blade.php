@php
    /** @var \App\Models\Quiz\Question $question */
    /** @var \App\Models\Quiz\Answer $answer */
@endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Edit quiz answer') }}</h1>
        <a href="{{ route('adm.quiz.question.show', $question) }}">
            <x-form.primary-button>{{ __('View quiz question') }}</x-form.primary-button>
        </a>
    </div>

    <div class="text-lg">{{ $question->question }}</div>

    <form action="{{ route('adm.quiz.answers.update', [$question, $answer]) }}" method="post" class="mt-4">
        @csrf
        @method('patch')
        @include('backend.quiz.answers._form')

        <div class="mt-3">
            <x-form.primary-button type="submit">{{ __('Update') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>
