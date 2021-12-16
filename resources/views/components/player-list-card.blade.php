@php /** @var \App\Models\User $player */ @endphp

<div
    class="w-full transition-colors duration-500 bg-gray-900 bg-opacity-0 hover:bg-opacity-80 border border-blue-400 border-opacity-25 hover:border-opacity-100 rounded-xl px-4 py-2">
    <div class="flex space-x-4">
        <div class="flex-shrink-0">
            @livewire('user.avatar', ['user' => $player, 'size' => 20])
        </div>
        <div class="flex-1">
            <div>
                <x-link href="{{ route('public-profile', $player) }}">
                    <span class="text-lg md:text-base xl:text-xl">{{ $player->username }}</span>
                </x-link>
                <span class="text-xs block">{{ __($player->role) }}</span>
                <div class="flex items-center justify-between mt-3">
                    <span
                        class="fflag ff-md ff-wave fflag-{{ $player->country }}"
                        title="{{ \App\Models\Country::name($player->country) }}"
                    ></span>
                    @auth
                        @unless(auth()->user()->is($player))
                            <div class="h-6 w-6">
                                <form action="{{ route('cabinet.dialogues.store', $player->username) }}" method="post">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="text-gray-300 hover:text-gray-200 transition"
                                        title="{{ __('Send message') }}"
                                    >
                                        <svg class="h-full w-full" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endunless
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
