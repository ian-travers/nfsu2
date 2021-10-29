@php /** @var \App\Models\Post $post */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('View post') }}</h1>
        <a href="{{ route('adm.posts.index') }}">
            <x-form.primary-button>{{ __('All posts') }}</x-form.primary-button>
        </a>
    </div>
    <x-backend.form-panel class="px-4 py-8 mt-8">
        <article>
            @if($post->hasImage())
                <div class="flex justify-center mb-6">
                    <img src="{{ $post->imageUrl() }}" alt="Feature Image" class="w-3/4">
                </div>
            @endif
            <div class="post__header-content">
                <p class="post__date font-mono">
                    {{ $post->published ? $post->published_at->isoFormat('LL') : $post->created_at->isoFormat('LL') }}
                </p>
                <h1 class="post__title text-5xl font-semibold tracking-wider my-3">
                    {{ $post->title }}
                </h1>
                <div class="post__author flex items-center space-x-4">
                    @livewire('user.avatar', ['user' => $post->author, 'size' => 8])
                    <a href="#"
                       class="text-blue-500 hover:text-blue-700 hover:underline focus:text-blue-700 transition">{{ $post->author->username }}</a>
                </div>
            </div>
            <div class="post_body mt-8">
                {!! $post->body !!}
            </div>
        </article>
    </x-backend.form-panel>
    <x-backend.form-panel class="px-4 py-4 my-4">
        <div class="text-lg">{{ __('Comments') }}</div>
        @if($post->comments->count())
            <div class="mt-4">
                @include('backend.comments._table', ['comments' => $post->comments])
            </div>
        @else
            <p class="mt-4">
                {{ __('There is no comments yet.') }}
            </p>
        @endif
    </x-backend.form-panel>
</x-layouts.back>
