@php
    use App\Models\Tourney\Tourney;

    /** @var Tourney $tourney */

    if ($tourney->status == Tourney::STATUS_SCHEDULED) {
        $classes = 'bg-blue-100 text-blue-800';
    } elseif ($tourney->status == Tourney::STATUS_DRAW) {
        $classes = 'bg-purple-100 text-purple-800';
    } elseif ($tourney->status == Tourney::STATUS_PASSED) {
        $classes = 'bg-gray-100 text-gray-800';
    } elseif ($tourney->status == Tourney::STATUS_CANCELLED) {
        $classes = 'bg-yellow-100 text-yellow-800';
    } else {
        $classes = 'bg-green-100 text-green-800';
    }
@endphp

<span
    {{ $attributes->merge(['class' => 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $classes ]) }}
>
    {{ $tourney->status() }}
</span>
