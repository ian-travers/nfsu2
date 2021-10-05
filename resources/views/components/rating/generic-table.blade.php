@props(['racers', 'type', 'season' => null])

<table class="border border-blue-400 divide-y divide-blue-200 w-full">
    <thead>
    <tr class="text-center divide-x divide-blue-400">
        <th class="w-1/12 px-4 py-2">#</th>
        <th class="hidden lg:w-1/12 lg:table-cell px-4 py-2">{{ __('Country') }}</th>
        <th class="hidden xl:w-1/12 xl:table-cell px-4 py-2">{{ __('Team') }}</th>
        <th class="w-1/6 px-4 py-2">{{ __('Player') }}</th>
        <th class="w-1/12 px-4 py-2">{{ __('Count') }}</th>
        <th class="w-1/12 px-4 py-2">{{ __('Pts.') }}</th>
        <th class="hidden xl:table-cell px-4 py-2">{{ __('Trophies') }}</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-blue-400">
    @foreach($racers as $racer)
        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
            <td class="text-center px-4 py-2">{{ $racer->getPlace($racers) }}</td>
            <td class="text-center hidden lg:table-cell  px-4 py-2">
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
                        @livewire('user.avatar', ['user' => $racer->user, 'size' => 6])
                        <x-link href="{{ route('public-profile', $racer->user->username) }}" class="ml-3">
                            {{ $racer->user->username }}
                        </x-link>
                    </div>
                @else
                    <span class="text-gray-400 line-through">{{ $racer->racer_username }}</span>
                @endif
            </td>
            <td class="text-right px-4 py-2">{{ $racer->count }}</td>
            <td class="text-right px-4 py-2">{{ $racer->pts }}</td>
            <td class="hidden xl:table-cell px-4 py-2">
                @foreach(\App\ReadRepositories\SeasonHelper::trophiesByUserId($racer->user_id, $type, $season) as $trophy)
                    <div class="inline-block focus:outline-none transform transition hover:scale-125">
                        <a href="{{ route($type . 's.show', $trophy->trophiable) }}"
                           title="{{ $trophy->htmlTitleAttribute() }}">
                            @if($type == 'tourney')
                                <x-tourney-medal
                                    place="{{ $trophy->place }}"
                                    type="{{ $trophy->trophiable->type() }}"
                                    size="6"
                                />
                            @elseif($type = 'competition')
                                <x-competition-medal
                                    place="{{ $trophy->place }}"
                                    size="6"
                                />
                            @endif
                        </a>
                    </div>
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
