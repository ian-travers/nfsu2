@php /** @var \App\Models\Tourney\TourneyDetail $detail */ @endphp
<table class="border border-blue-400 divide-y divide-blue-200 w-full">
    <thead>
    <tr class="text-center divide-x divide-blue-400">
        <th class="px-4 py-2">#</th>
        <th class="px-4 py-2">{{ __('Player') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($tourney->details as $detail)
        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
            <td class="text-center px-4 py-2">{{ $loop->index + 1 }}</td>
            <td class="px-4 py-2 whitespace-nowrap {{ $detail->racer->trashed() ? 'line-through' : '' }}">
                {{ $detail->racer_username }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
