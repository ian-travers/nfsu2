@props(['news'])

<div class="lg:grid lg:grid-cols-2 lg:gap-2">
    <x-news.featured-card :newsitem="$news[0]"/>
    <div>
        @if($news->count() > 1)
            <div>
                @foreach($news->skip(1) as $newsitem)
                    <x-news.card :newsitem="$newsitem"/>
                @endforeach
            </div>
        @endif
    </div>
</div>
