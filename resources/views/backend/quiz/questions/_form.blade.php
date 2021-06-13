@php /** @var \App\Models\Quiz\Question $question */ @endphp

<div class="mt-4">
    <x-form.label for="question_en" value="{{ __('In English') }}"/>
    <x-form.input
        id="question_en"
        class="block mt-1 w-full"
        type="text"
        name="question_en"
        value="{{ old('question_en', $question->question_en) }}"
        autofocus
        autocomplete="question_en"
    />
    @error('question_en')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="question_ru" value="{{ __('In Russian') }}"/>
    <x-form.input
        id="question_ru"
        class="block mt-1 w-full"
        type="text"
        name="question_ru"
        value="{{ old('question_ru', $question->question_ru) }}"
        autofocus
        autocomplete="question_ru"
    />
    @error('question_ru')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="correct_answer" value="{{ __('Correct answer') }}"/>
    <x-form.input
        id="correct_answer"
        class="block mt-1 w-full"
        type="text"
        name="correct_answer"
        value="{{ old('correct_answer', $question->correct_answer) }}"
        autocomplete="correct_answer"
    />
    @error('correct_answer')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>
