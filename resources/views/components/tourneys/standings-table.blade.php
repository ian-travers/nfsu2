@php /** @var \App\Models\Tourney\TourneyRacer $racer */ @endphp
<table class="border border-blue-400 divide-y divide-blue-200 w-full">
    <thead>
    <tr class="text-center divide-x divide-blue-400">
        <th class="px-4 py-2">#</th>
        <th class="hidden lg:table-cell px-4 py-2">{{ __('Country') }}</th>
        <th class="hidden xl:table-cell px-4 py-2">{{ __('Team') }}</th>
        <th class="px-4 py-2">{{ __('Player') }}</th>
        <th class="px-4 py-2">{{ __('Pts.') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($tourney->racers as $racer)
        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
            <td class="text-center px-4 py-2">{{ $loop->index + 1 }}</td>
            <td class="text-center hidden lg:table-cell  px-4 py-2">
                <span class="fflag ff-md fflag-{{ $racer->racer->country }}"></span>
            </td>
            <td class="hidden xl:table-cell px-4 py-2">{{ $racer->racer->isTeamMember() ? $racer->racer->team->clan : ''}}</td>
            <td class="px-4 py-2">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-6 w-6">
                        @livewire('user.avatar', ['user' => $racer->racer])
                    </div>
                    <div class="ml-3">
                        {{ $racer->racer_username }}
                    </div>
                </div>
            </td>
            <td class="text-right px-4 py-2">{{ $racer->pts }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
