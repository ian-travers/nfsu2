@php /** @var \App\Models\Post $post */ @endphp

<x-backend.form-panel class="px-4 py-8 my-8">
    <div>
        <x-form.label for="title" value="{{ __('Title') }}"/>
        <x-form.input
            id="title"
            class="block mt-1 w-full"
            type="text"
            name="title"
            value="{{ old('title', $post->title) }}"
            autofocus
            autocomplete="title"
        />
        @error('title')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="excerpt" value="{{ __('Excerpt') }}"/>
        <textarea
            id="excerpt"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            name="excerpt"
            rows="5"
        >{{ old('excerpt', $post->excerpt) }}</textarea>
        @error('excerpt')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>

    <div>
        <x-form.label for="body" value="{{ __('Body') }}"/>
        <x-rich-editor
            class="w-full"
            name="body"
            value="{!! old('body', $post->body) !!}"
        />
        @error('body')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
</x-backend.form-panel>
