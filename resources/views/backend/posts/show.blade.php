@php /** @var \App\Models\Post $post */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('View post') }}</h1>
        <a href="{{ route('adm.posts.index') }}">
            <x-form.primary-button>{{ __('All posts') }}</x-form.primary-button>
        </a>
    </div>
    <x-backend.form-panel class="px-4 py-8 mt-8">
        <div class="text-xl font-bold">
            {{ $post->title }}
        </div>
        <div class="text-lg font-semibold">
            {{ $post->excerpt }}
        </div>
        <div>
            {!! $post->body !!}
        </div>
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
