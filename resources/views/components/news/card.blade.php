@php /** @var \App\Models\News $newsitem */ @endphp

@props(['newsitem'])

<article
    {{ $attributes(['class' => 'transition-colors duration-500 bg-gray-900 bg-opacity-0 hover:bg-opacity-80 border border-blue-400 border-opacity-0 hover:border-opacity-100 rounded-xl']) }}
>
    <div class="py-4 px-5">
        <div class="flex flex-col justify-between">
            <header>
                <div class="mt-4">
                    <h1 class="text-3xl">
                        <x-link href="{{ route('news.view', $newsitem) }}">
                            {{ $newsitem->title }}
                        </x-link>
                    </h1>
                    <span class="mt-2 block text-gray-400 text-xs">
                        <time>{{ $newsitem->created_at->isoFormat('LLL') }}</time>
                    </span>
                </div>
            </header>

            <div class="text-sm mt-4 space-y-4">
                {!! Str::words($newsitem->body, 12) !!}
            </div>
        </div>
    </div>
</article>

