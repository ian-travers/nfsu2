@php /** @var \App\Models\News $newsitem */ @endphp

@props(['newsitem'])

<article
    {{ $attributes(['class' => 'transition-colors duration-500 bg-gray-900 bg-opacity-0 hover:bg-opacity-80 border border-blue-400 border-opacity-0 hover:border-opacity-100 rounded-xl']) }}>
    <div class="py-4 px-5">
        <div class="flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="mt-4">
                    <h1 class="text-4xl">
                        <x-link href="{{ route('news.view', $newsitem) }}">
                            {{ $newsitem->title }}
                        </x-link>
                    </h1>
                    <span class="mt-2 block text-gray-400 text-sm">
                        <time>{{ $newsitem->created_at->isoFormat('LLL') }}</time>
                    </span>
                </div>
            </header>
            <div class="text-lg mt-8">
                {!! Str::words($newsitem->body, 100) !!}
            </div>
        </div>
    </div>
</article>

