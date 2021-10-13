@props(['tourney', 'display' => 'frontend'])

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
            <td class="text-center px-4 py-2">{{ $racer->place }}</td>
            <td class="text-center hidden lg:table-cell px-4 py-2">
                @if($racer->user)
                    <span class="fflag ff-md fflag-{{ $racer->user->country }}"></span>
                @endif
            </td>
            <td class="hidden xl:table-cell px-4 py-2">
                @if($racer->user)
                    @if($racer->user->isTeamMember())
                        <a href="{{ route('team-profile', $racer->user->team) }}" class="hover:underline">
                            {{ $racer->user->team->clan }}
                        </a>
                    @endif
                @endif
            </td>
            <td class="px-4 py-2">
                @if($racer->user)
                    <div class="flex items-center">
                        @livewire('user.avatar', ['user' => $racer->user, 'size' => 5])
                        @if($display == 'frontend')
                            <x-link href="{{ route('public-profile', $racer->user->username) }}" class="ml-2">
                                {{ $racer->user->username }}
                            </x-link>
                        @else
                            <x-link href="{{ route('public-profile', $racer->user->username) }}" class="text-indigo-600 hover:text-indigo-700 ml-2">
                                {{ $racer->user->username }}
                            </x-link>
                        @endif
                    </div>
                @else
                    <span class="text-gray-400 line-through">{{ $racer->racer_username }}</span>
                @endif
            </td>
            <td class="text-right px-4 py-2">{{ $racer->pts }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
