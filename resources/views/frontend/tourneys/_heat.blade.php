@php /** @var \App\Models\Tourney\HeatRacer $racer */ @endphp

<table class="divide-y divide-blue-200 border border-blue-400 w-full">
    <thead>
    <tr class="divide-x divide-blue-400">
        <th class="px-2 py-3">#</th>
        <th class="px-2 py-3">{{ __('Username') }}</th>
        <th class="text-right px-2 py-3">{{ __('Place') }}</th>
        <th class="text-right px-2 py-3">{{ __('Pts.') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($racers as $racer)
        <tr class="divide-x divide-blue-400 {{ $racer->place == 1 ? 'bg-green-600 bg-opacity-20' : '' }}">
            <td class="text-center px-2 py-1">{{ $loop->index + 1 }}</td>
            <td class="px-2 py-1">{{ $racer->racer_username }}</td>
            <td class="text-right px-2 py-1">{{ $racer->place }}</td>
            <td class="text-right px-2 py-1">{{ $racer->pts }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

