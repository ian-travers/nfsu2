@props(['rating', 'resultAlignRight'])

<table class="border border-blue-400 divide-y divide-blue-200 w-full">
    <thead>
    <tr class="text-center divide-x divide-blue-400">
        <th class="px-4 py-2">#</th>
        <th class="px-4 py-2">{{ __('Player') }}</th>
        <th class="hidden lg:table-cell px-4 py-2">{{ __('Result') }}</th>
        <th class="hidden xl:table-cell px-4 py-2">{{ __('Car') }}</th>
        <th class="px-4 py-2">{{ __('Pts.') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($rating as $racer)
        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
            <td class="text-center px-4 py-2">{{ $racer['place'] }}</td>
            <td class="px-4 py-2">{{ $racer['username'] }}</td>
            <td class="hidden lg:table-cell px-4 py-2 {{ $resultAlignRight ? 'text-right' : '' }}">{{ $racer['result'] }}</td>
            <td class="hidden xl:table-cell px-4 py-2">{{ $racer['car'] }}</td>
            <td class="text-right px-4 py-2">{{ $racer['pts'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
