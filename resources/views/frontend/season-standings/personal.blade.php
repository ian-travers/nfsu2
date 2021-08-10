<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Personal standings') }}</h2>

        <div class="lg:grid lg:grid-cols-3 lg:gap-4">
            <div>
                <p class="block mb-1 ml-2">{{ __('Type') }}</p>
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center justify-between bg-transparent font-medium rounded-md w-full text-left border border-blue-400 hover:border-blue-300 focus:border-blue-300 px-3 py-2"
                        >
                            {{ request('type') !== null ? ucfirst(request('type')) : __('Overall') }}
                            <svg class="h-5 w-5 ml-0.5 inline-flex" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    @foreach($types as $type)
                        <x-dropdown-link
                            href="{{ $type == 'overall'
                                ? route('season-standings.personal') . '/?' . http_build_query(request()->except('type'))
                                : route('season-standings.personal') . '/?type=' . $type . '&' .http_build_query(request()->except('type'))
                            }}"
                        >
                            {{ __(ucfirst($type)) }}
                        </x-dropdown-link>
                    @endforeach
                </x-dropdown>
            </div>

            <div>
                <p class="block mb-1">{{ __('Country') }}</p>
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center justify-between bg-transparent font-medium rounded-md w-full text-left border border-blue-400 hover:border-blue-300 focus:border-blue-300 px-3 py-2"
                        >
                            {{ request('country') !== null ? $countries[request('country')] : __('All') }}
                            <svg class="h-5 w-5 ml-0.5 inline-flex" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    @foreach($countries as $key => $country)
                        <x-dropdown-link
                            href="{{ $key == 'ALL'
                                ? route('season-standings.personal') . '/?' . http_build_query(request()->except('country'))
                                : route('season-standings.personal') . '/?country=' . $key . '&' .http_build_query(request()->except('country'))
                            }}"
                        >
                            {{ ucfirst($country) }}
                        </x-dropdown-link>
                    @endforeach
                </x-dropdown>
            </div>

            <div>
                <p class="block mb-1">{{ __('Team') }}</p>
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center justify-between bg-transparent font-medium rounded-md w-full text-left border border-blue-400 hover:border-blue-300 focus:border-blue-300 px-3 py-2"
                        >
                            {{ request('team') !== null ? $teams[(request('team'))] : __('All') }}
                            <svg class="h-5 w-5 ml-0.5 inline-flex" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>
                    @foreach($teams as $key => $team)
                        <x-dropdown-link
                            href="{{ $key == 'ALL'
                                ? route('season-standings.personal') . '/?' . http_build_query(request()->except('team'))
                                : route('season-standings.personal') . '/?team=' . $key . '&' .http_build_query(request()->except('team'))
                            }}"
                        >
                            {{ $team }}
                        </x-dropdown-link>
                    @endforeach
                </x-dropdown>
            </div>
        </div>
    </div>
</x-layouts.front>
