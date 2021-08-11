@php /** @var \App\Models\Tourney\SeasonRacer $racer */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Personal standings') }}</h2>
        {{-- Filters--}}
        <div class="lg:grid lg:grid-cols-3 lg:gap-4">
            <div>
                @include('frontend.season-standings._type-filter')
            </div>
            <div>
                @include('frontend.season-standings._country-filter')
            </div>
            <div>
                @include('frontend.season-standings._team-filter')
            </div>
        </div>
        {{-- End filters--}}

        {{-- Table --}}
        <div class="mt-8">
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
                                {{ $racer->user->isTeamMember() ? $racer->user->team->clan : ''}}
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if($racer->user)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-6 w-6">
                                        @livewire('user.avatar', ['user' => $racer->user])
                                    </div>
                                    <div class="ml-3">
                                        <a href="{{ route('public-profile', $racer->user->username) }}">
                                            {{ $racer->user->username }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400">{{ $racer->user->username }}</span>
                            @endif
                        </td>
                        <td class="text-right px-4 py-2">{{ $racer->pts }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.front>
