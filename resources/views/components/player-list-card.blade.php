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
                    <span class="text-xl">{{ $player->username }}</span>
                </x-link>
                <span class="text-xs block">{{ __($player->role) }}</span>
                <div class="flex items-baseline mt-3">
                    <span class="fflag ff-md ff-wave fflag-{{ $player->country }}" title="{{ \App\Models\Country::name($player->country) }}"></span>
                </div>
            </div>
        </div>
    </div>
</div>