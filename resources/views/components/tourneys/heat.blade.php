@php /** @var \App\Models\Tourney\HeatRacer $racer */ @endphp

<table class="divide-y divide-gray-200 border">
    <thead class="bg-gray-50">
    <tr>
        <x-table.th>#</x-table.th>
        <x-table.th>{{ __('Username') }}</x-table.th>
        <x-table.th>{{ __('Place') }}</x-table.th>
        <x-table.th>{{ __('Pts.') }}</x-table.th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($racers as $racer)
        <tr>
            <td class="text-center px-2 py-1">{{ $loop->index + 1 }}</td>
            <td class="px-2 py-1">{{ $racer->racer_username }}</td>
            <td class="text-right px-2 py-1">{{ $racer->place }}</td>
            <td class="text-right px-2 py-1">{{ $racer->pts }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
