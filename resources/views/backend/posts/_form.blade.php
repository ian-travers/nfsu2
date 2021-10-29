@php /** @var \App\Models\Post $post */ @endphp

<x-backend.form-panel class="px-4 py-8 my-8">
    <div class="grid grid-cols-3 gap-x-4">
        <div class="col-span-2">
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
        </div>

        <div>
            <x-form.label value="{{ __('Image') }}"/>
            <div
                id="preview"
                class="image-preview flex justify-center items-center w-full h-40 border-2 border-gray-300"
            >
                @if($post->hasImage())
                    <img class="preview__image max-h-40" src="{{ $post->imageUrl() }}" alt="Image preview">
                    <span
                        class="preview__default-text hidden text-gray-300 text-2xl font-semibold tracking-wider">{{ __('Image preview') }}</span>
                @else
                    <img class="preview__image hidden max-h-40" src="" alt="Image preview">
                    <span
                        class="preview__default-text text-gray-300 text-2xl font-semibold tracking-wider">{{ __('Image preview') }}</span>
                @endif
            </div>
            <div class="flex items-center justify-center space-x-4 mt-4">
                <input type="file" class="inputfile" name="image" id="image">
                <label
                    for="image"
                    class="items-center px-4 py-2 bg-blue-500 rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-700 focus:bg-blue-700 transition"
                >
                    {{ __('Upload new image') }}
                </label>
                @if($post->hasImage())
                    @livewire('post.remove-image', ['post' => $post])
                @endif
            </div>
        </div>
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
<script>
    const inputFile = document.querySelector('#image')
    const previewContainer = document.querySelector('#preview')
    const previewImage = previewContainer.querySelector('.preview__image')
    const previewDefaultText = previewContainer.querySelector('.preview__default-text')

    inputFile.addEventListener('change', function () {
        const file = this.files[0]

        if (file) {
            const reader = new FileReader()

            previewDefaultText.style.display = 'none'
            previewImage.style.display = 'block'

            reader.readAsDataURL(file);
            reader.addEventListener('load', function () {
                previewImage.setAttribute('src', this.result)
            })
        } else {
            previewDefaultText.style.display = null
            previewImage.style.display = null
        }
    })
</script>
