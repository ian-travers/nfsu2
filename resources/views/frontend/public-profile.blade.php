@php /** @var \App\Models\User $user */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Public profile') }}</h2>

        <div class="flex items-center space-x-8">
            <div class="flex-shrink-0">
                @livewire('user.avatar', ['user' => $user, 'size' => 32])
            </div>
            <div class="flex space-x-4">
                <div class="text-4xl">{{ $user->username }}</div>
                <div class="-mt-2">
                    <span class="fflag ff-lg ff-wave fflag-{{ $user->country }}"></span>
                </div>

            </div>
        </div>
    </div>
</x-layouts.front>
