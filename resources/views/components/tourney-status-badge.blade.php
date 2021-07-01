@php
    use App\Models\Tourney\Tourney;

    /** @var Tourney $tourney */

    if ($tourney->isScheduled()) {
        $classes = 'bg-blue-100 text-blue-800';
    } elseif ($tourney->isDraw()) {
        $classes = 'bg-purple-100 text-purple-800';
    } elseif ($tourney->isCompleted()) {
        $classes = 'bg-gray-100 text-gray-800';
    } elseif ($tourney->isCancelled()) {
        $classes = 'bg-yellow-100 text-yellow-800';
    } else {
        $classes = 'bg-green-100 text-green-800';
    }
@endphp

<span
    {{ $attributes->merge(['class' => 'px-2.5 py-0.5 inline-flex items-center text-xs font-medium rounded-full ' . $classes ]) }}
>
    {{ $tourney->status() }}
</span>
