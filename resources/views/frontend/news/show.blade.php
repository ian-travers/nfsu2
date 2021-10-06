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
            <div class="text-lg mt-4 lg:mt-8">
                {!! $newsitem->body !!}
            </div>
        </article>
    </div>
</x-layouts.front>
