@php /** @var \App\Models\Tourney\SeasonRacer $racer */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Tourney countries standing') }}</h2>
        @if(count($countries))
            <div class="w-1/3">
                @include('frontend.season-standings._type-filter', ['route' => route('season-standings.tourney-countries')])
            </div>

            {{-- Table --}}
            <div class="mt-8">
                <table class="border border-blue-400 divide-y divide-blue-200 w-full">
                    <thead>
                    <tr class="text-center divide-x divide-blue-400">
                        <th class="w-1/12 px-4 py-2">#</th>
                        <th class="w-1/12 px-4 py-2">{{ __('Flag') }}</th>
                        <th class="w-1/3 px-4 py-2">{{ __('Country') }}</th>
                        <th class="w-1/6 px-4 py-2">{{ __('Racers') }}</th>
                        <th class="w-1/6 px-4 py-2">{{ __('Count') }}</th>
                        <th class="w-1/6 px-4 py-2">{{ __('Pts.') }}</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-400">
                    @foreach($countries as $country)
                        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
                            <td class="text-center px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="text-center px-4 py-2">
                                <span class="fflag ff-md fflag-{{ $country->country }}"></span>
                            </td>
                            <td class="px-4 py-2">{{ \App\Models\Country::name($country->country) }}</td>
                            <td class="text-right px-4 py-2">{{ $country->racers_count }}</td>
                            <td class="text-right px-4 py-2">{{ $country->tourneys_count }}</td>
                            <td class="text-right px-4 py-2">{{ $country->pts }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{ __('There is no tourneys yet.') }}
        @endif
    </div>

</x-layouts.front>
