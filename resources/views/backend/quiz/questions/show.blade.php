@php /** @var \App\Models\Quiz\Question $question */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('View quiz question') }}</h1>
        <div class="flex">
            <a href="{{ route('adm.quiz.question.edit', $question) }}">
                <x-form.primary-button>{{ __('Edit') }}</x-form.primary-button>
            </a>
            <form action="{{ route('adm.quiz.question.delete', $question) }}" method="post" class="ml-1">
                @csrf
                @method('delete')
                <x-form.danger-button
                    type="submit"
                    onclick="return confirm(_t('This quiz question will be deleted! Proceed?'))"
                >
                    {{ __('Delete') }}
                </x-form.danger-button>
                <a href="{{ route('adm.quiz.question.index') }}">
                    <x-form.primary-button>{{ __('All questions') }}</x-form.primary-button>
                </a>
            </form>
        </div>
    </div>

    <div class="my-4">
            <p class="text-xs text-gray-400 uppercase">{{ __('In English') }}</p>
            <p class="text-lg">{{ $question->question_en }}</p>

            <p class="text-xs text-gray-400 uppercase mt-4">{{ __('In Russian') }}</p>
            <p class="text-lg">{{ $question->question_ru }}</p>

            <p class="text-xs text-gray-400 uppercase mt-4">{{ __('Correct answer') }}</p>
            <p class="text-lg">{{ $question->correct_answer }}</p>
    </div>
    <div class="my-4 border-t border-gray-400">
        <div class="flex items-center justify-between">
            <h3 class="text-xl my-5">{{ __('Answer options') }}</h3>
            <a href="{{ route('adm.quiz.answers.create', $question) }}">
                <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
            </a>
        </div>


        @include('backend.quiz.answers._table', ['answers' => $question->answers])
    </div>
</x-layouts.back>
