<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Quiz Questions') }}</h1>
        <a href="{{ route('adm.quiz.question.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>

    @if($questions->count())
        <div class="mt-4">
            @include('backend.quiz.questions._table')

            <div class="my-4">
                {{ $questions->links() }}
            </div>
        </div>
    @else
        <p class="mt-4">
            {{ __('There is no questions yet') }}
        </p>
    @endif
</x-layouts.back>
