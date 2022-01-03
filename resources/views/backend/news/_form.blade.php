@php /** @var \App\Models\News $newsitem */ @endphp

<x-backend.form-panel class="px-4 py-8 my-8">
    <div class="md:grid md:grid-cols-2 md:gap-4">
        <div>
            <x-form.label for="title_en" value="{{ __('Title En') }}"/>
            <x-form.input
                id="title_en"
                class="block mt-1 w-full"
                type="text"
                name="title_en"
                value="{{ old('title_en', $newsitem->title_en) }}"
                autofocus
                autocomplete="title_en"
            />
            @error('title_en')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <x-form.label for="title_ru" value="{{ __('Title Ru') }}"/>
            <x-form.input
                id="title_ru"
                class="block mt-1 w-full"
                type="text"
                name="title_ru"
                value="{{ old('title_ru', $newsitem->title_ru) }}"
                autocomplete="title_ru"
            />
            @error('title_ru')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <x-form.label for="body_en" value="{{ __('Body En') }}"/>
            <x-rich-editor
                id="body_en"
                class="w-full"
                name="body_en"
                value="{!! old('body_en', $newsitem->body_en) !!}"
            />
            @error('body_en')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <x-form.label for="body_ru" value="{{ __('Body Ru') }}"/>
            <x-rich-editor
                id="body_ru"
                class="w-full"
                name="body_ru"
                value="{!! old('body_ru', $newsitem->body_ru) !!}"
            />
{{--            @error('body_ru')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror--}}
        </div>
    </div>
    <div class="mt-6">
        <x-form.label for="status" value="{{ __('Status') }}"/>
        <x-form.input
            id="status"
            class="block mt-1 w-full"
            type="text"
            name="status"
            value="{{ old('status', $newsitem->status) }}"
        />

        @error('status')
            <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
        @else
            <p class="text-gray-500 mt-1 text-xs">{{ __('1 - published | 0 - unpublished') }}</p>
        @enderror
    </div>
</x-backend.form-panel>
