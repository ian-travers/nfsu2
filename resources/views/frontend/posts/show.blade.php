@php /** @var \App\Models\Post $post */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <div class="flex justify-end pt-4">
            <x-link href="{{ route('blog.index') }}">
                {{ __('All Blog Posts') }}
            </x-link>
        </div>
        <article class="mt-8">
            @if($post->hasImage())
                <div class="flex justify-center mb-6">
                    <img src="{{ $post->imageUrl() }}" alt="Feature Image" class="w-3/4">
                </div>
            @endif
            <div>
                <p class="font-mono">
                    {{ $post->published ? $post->published_at->isoFormat('LL') : $post->created_at->isoFormat('LL') }}
                </p>
                <h1 class="post__title text-5xl font-semibold tracking-wider my-3">
                    {{ $post->title }}
                </h1>
                <div class="flex items-center">
                    <div class="flex items-center space-x-2.5 mr-4">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ visits($post)->count() }}</span>
                    </div>
                    @livewire('user.avatar', ['user' => $post->author, 'size' => 8])
                    <x-link href="{{ route('public-profile', $post->author->username) }}" class="ml-4">
                        {{ $post->author->username }}
                    </x-link>
                    <div class="ml-12">
                        @livewire('like-dislike', ['model' => $post])
                    </div>
                </div>
            </div>
            <div class="post_body mt-8">
                {!! $post->body !!}
            </div>
                {{-- comments--}}
                <div class="mt-8 py-4 border-t border-blue-400">
                    <div class="mt-6">
                        @livewire('comment.all', ['comments' => $commentViews, 'count' => $post->comments_count,
                        'commentable' => $post])
                    </div>
                </div>
        </article>
    </div>

    @include('frontend._commentJs')
</x-layouts.front>
