@if($competitions->count())
    <div class="md:grid md:grid-cols-2 md:gap-4 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4 xl:gap-8 space-y-3 lg:space-y-0">
        @foreach($competitions as $competition)
            <a href="{{ route('competitions.show', $competition) }}">
                <x-competitions.card :competition="$competition"/>
            </a>
        @endforeach
    </div>
@else
    <div class="mt-4">{{ __('There is no competitions yet.') }}</div>
@endif
