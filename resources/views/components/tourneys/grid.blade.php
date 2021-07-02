@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp
{{--Featured--}}
@foreach($featuredTourneys as $tourney)
    <x-tourneys.featured-card :tourney="$tourney"/>
@endforeach

{{--Grid--}}
<div class="lg:grid lg:grid-cols-2 lg:gap-4 space-y-3 lg:space-y-0">
    @foreach($tourneys as $tourney)
        <x-tourneys.card :tourney="$tourney"/>
    @endforeach
</div>
