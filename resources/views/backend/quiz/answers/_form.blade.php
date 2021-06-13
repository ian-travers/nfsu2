@php /** @var \App\Models\Quiz\Question $question */ @endphp

<div class="mt-4">
    <x-form.label for="question_en" value="{{ __('In English') }}"/>
    <x-form.input
        id="question_en"
        class="block mt-1 w-full"
        type="text"
        name="answer_en"
        value="{{ old('answer_en', $answer->answer_en) }}"
        autofocus
        autocomplete="answer_en"
    />
    @error('answer_en')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="answer_ru" value="{{ __('In Russian') }}"/>
    <x-form.input
        id="answer_ru"
        class="block mt-1 w-full"
        type="text"
        name="answer_ru"
        value="{{ old('answer_ru', $answer->answer_ru) }}"
        autofocus
        autocomplete="answer_ru"
    />
    @error('answer_ru')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>

<div class="mt-4">
    <x-form.label for="index" value="{{ __('Index') }}"/>
    <x-form.input
        id="index"
        class="block mt-1 w-full"
        type="text"
        name="index"
        value="{{ old('index', $answer->index) }}"
        autocomplete="index"
    />
    @error('index')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
</div>
