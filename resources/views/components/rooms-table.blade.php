<table class="table-auto w-full border border-blue-400">
    <tbody class="divide-y divide-blue-400">
    @foreach($rooms as $room)
        <tr>
            <td class="px-4 py-2 border-r border-blue-400" colspan="4">{{ $room['name'] }}</td>
            <td class="px-4 py-2 text-right">{{ $room['count'] }}</td>
        </tr>

        @if ((int)$room['players'])
            @foreach ($room['players'] as $name)
                <tr>
                    <td class="pl-8" colspan="5">{{ $name }}</td>
                </tr>
            @endforeach
        @endif
    @endforeach
    </tbody>
</table>


