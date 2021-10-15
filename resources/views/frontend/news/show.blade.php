@php /** @var \App\Models\News $newsitem */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <div class="flex justify-end pt-4">
            <x-link href="{{ route('news.index') }}">
                {{ __('All news') }}
            </x-link>
        </div>
        <article>
            <p class="text-gray-400 text-sm">
                <time>{{ $newsitem->created_at->isoFormat('LL') }}</time>
            </p>
            <h1 class="text-3xl mt-1">
                {{ $newsitem->title }}
            </h1>
            <div class="my-4">
                @livewire('like-dislike', ['model' => $newsitem])
            </div>
            <div class="text-lg mt-4 lg:mt-8">
                {!! $newsitem->body !!}
            </div>

            {{-- comments--}}
            <div class="mt-8 py-4 border-t border-blue-400">
                <div class="mt-6">
                    @livewire('comment.all', ['comments' => $commentViews, 'count' => $newsitem->comments_count,
                    'commentable' => $newsitem])
                </div>
            </div>
        </article>
    </div>

    @include('frontend._commentJs')
</x-layouts.front>
