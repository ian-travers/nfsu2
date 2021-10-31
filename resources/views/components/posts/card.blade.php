@props(['post'])

@php /** @var \App\Models\Post $post */ @endphp

<article
    {{ $attributes(['class' => 'transition-colors duration-500 bg-gray-900 bg-opacity-0 hover:bg-opacity-80 border border-blue-400 border-opacity-25 hover:border-opacity-100 rounded-xl']) }}
>
    <div class="py-4 px-5">
        <div class="flex flex-col justify-between">
            <header>
                <div class="flex justify-center w-full p-4">
                    @if($post->hasImage())
                        <img src="{{ $post->imageUrl() }}" class="h-48" alt="Post Image">
                    @else
                        <div class="flex justify-center items-center border-4 border-gray-600 w-full h-48">
                            <span class="text-2xl font-semibold tracking-wider">{{ __('No image') }}</span>
                        </div>
                    @endif
                </div>
                <div class="mt-4">
                    <h1 class="text-3xl">
                        <x-link href="{{ route('blog.view', $post) }}">
                            {{ $post->title }}
                        </x-link>
                    </h1>
                    <span class="mt-2 block text-gray-400 text-xs">
                        <time>{{ $post->published_at->isoFormat('LL') }}</time>
                    </span>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    @livewire('user.avatar', ['user' => $post->author, 'size' => 8])
                    <x-link href="{{ route('public-profile', $post->author->username) }}">
                        {{ $post->author->username }}
                    </x-link>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                {{ $post->excerpt }}
            </div>
        </div>
    </div>
</article>

