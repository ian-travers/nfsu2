@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div class="p-4 md:p-8 bg-nfsu-color bg-opacity-50 border border-blue-400">
    <h2 class="text-center text-xl md:text-3xl tracking-wider font-medium">
        {{ __('Current competition') }}
    </h2>
    <div class="grid gap-4 grid-cols-1 md:gap-6 md:grid-cols-2">
        @foreach($competition->ratings() as $trackName => $rating)
            <div>
                <h4 class="text-lg text-center mb-4">{{ $trackName }}</h4>
                <table class="border border-blue-400 divide-y divide-blue-200 w-full">
                    <thead>
                    <tr class="text-center divide-x divide-blue-400">
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">{{ __('Player') }}</th>
                        <th class="px-4 py-2">{{ __('Result') }}</th>
                        <th class="px-4 py-2">{{ __('Car') }}</th>
                        <th class="px-4 py-2">{{ __('Pts') }}</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-400">
                    @foreach($rating as $racer)
                        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
                            <td class="text-center px-4 py-2">{{ $racer['place'] }}</td>
                            <td class="px-4 py-2">{{ $racer['username'] }}</td>
                            <td class="px-4 py-2">{{ $racer['result'] }}</td>
                            <td class="px-4 py-2">{{ $racer['car'] }}</td>
                            <td class="text-right px-4 py-2">{{ $racer['pts'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>

