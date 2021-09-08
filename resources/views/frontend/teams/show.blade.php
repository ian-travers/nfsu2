@php /** @var \App\Models\Team $team */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Team profile') }}</h2>

        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <p class="text-4xl">
                    {{ $team->name }}
                    <span
                        class="inline-flex items-center px-3 py-0.5 rounded-full text-2xl font-medium bg-indigo-100 text-indigo-800">
                    {{ $team->racers()->count() }}
                    </span>

                    <span
                        class="text-sm block">{{ __('Registered :date', ['date' => $team->created_at->diffForHumans()]) }}</span>
                </p>
                <p class="mt-4">
                    {{ __('Captain') }}:
                    <a href="{{ route('public-profile', $team->captain) }}"
                       class="text-2xl hover:underline">{{ $team->captain->username }}</a>
                </p>
            </div>
            <div class="mt-8 lg:mt-0">
                <table class="border border-blue-400 divide-y divide-blue-200 w-full">
                    <tbody class="divide-y divide-blue-400">
                    @foreach($team->racers as $user)
                        <tr class="divide-x divide-blue-400 transition-colors duration-300 hover:bg-blue-100 hover:bg-opacity-20">
                            <td class="w-1/6 text-center px-4 py-2">
                                <span class="fflag ff-md fflag-{{ $user->country }}"></span>
                            </td>
                            <td class="w-1/6 px-4 py-2">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        @livewire('user.avatar', ['user' => $user, 'size' => 6])
                                    </div>
                                    <div class="ml-2">
                                        <div class="hover:underline ml-2">
                                            <a href="{{ route('public-profile', $user->username) }}">
                                                {{ $user->username }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-4 py-2">
                                @if($user->trophies()->count())
                                    @foreach($user->trophies as $trophy)
                                        @if($trophy->trophiable_type == "tourney")
                                            <div
                                                class="inline-block focus:outline-none transform transition hover:scale-125">
                                                <a href="{{ route('tourneys.show', $trophy->trophiable) }}"
                                                   title="{{ $trophy->htmlTitleAttribute() }}">
                                                    <x-tourney-medal
                                                        place="{{ $trophy->place }}"
                                                        type="{{ $trophy->trophiable->type() }}"
                                                        size="6"
                                                    />
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.front>
