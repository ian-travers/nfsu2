@php /** @var \App\Models\Tourney\TourneyDetail $detail */ @endphp
<table class="border border-blue-400 divide-y divide-blue-200 w-full">
    <thead>
    <tr class="text-center divide-x divide-blue-400">
        <th class="px-4 py-2">#</th>
        <th class="px-4 py-2">{{ __('Country') }}</th>
        <th class="px-4 py-2">{{ __('Team') }}</th>
        <th class="px-4 py-2">{{ __('Player') }}</th>
        <th class="px-4 py-2">{{ __('Pts.') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($tourney->details as $detail)
        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
            <td class="text-center px-4 py-2">{{ $loop->index + 1 }}</td>
            @if($detail->racer->trashed())
                <td></td>
                <td></td>
                <td class="pl-3 line-through">{{ $detail->racer_username }}</td>
            @else
                <td class="text-center px-4 py-2">
                    <span class="fflag ff-md fflag-{{ $detail->racer->country }}"></span>
                </td>
                <td class="px-4 py-2">{{ $detail->racer->isTeamMember() ? $detail->racer->team->clan : ''}}</td>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-6 w-6">
                            @livewire('user.avatar', ['user' => $detail->racer])
                        </div>
                        <div class="ml-3 {{ $detail->racer->trashed() ? 'line-through' : '' }}">
                            {{ $detail->racer_username }}
                        </div>
                    </div>
                </td>
            @endif
            <td class="text-right px-4 py-2">{{ $detail->pts }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
