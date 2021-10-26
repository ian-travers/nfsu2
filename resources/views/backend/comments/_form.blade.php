@php /** @var \App\Models\Comment $comment */ @endphp

<x-backend.form-panel class="px-4 py-8 my-8">
    <div class="mb-8">
        <span class="text-gray-400">{{ $comment->updated_at->format('Y-m-d H:i') }}</span>
        <span class="font-semibold">{{ $comment->author->username }}</span>
        {{ __('left a comment') }}
    </div>
    <div>
        <x-form.label for="body" value="{{ __('Body') }}"/>
        <textarea
            id="body"
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
            name="body"
            rows="5"
        >{{ old('body', $comment->body) }}</textarea>
        @error('body')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
</x-backend.form-panel>
