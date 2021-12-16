<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your private dialogues') }}</h1>
                <a href="{{ route('players-list') }}">
                    <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
                </a>
            </div>

            @if($dialogues->count())
                <div class="mt-4">
                    <div
                        class="grid grid-cols-2 gap-2 md:grid md:grid-cols-3 md:gap-3 lg:grid lg:grid-cols-4 lg:gap-4 xl:grid xl:grid-cols-6 xl:gap-4">
                        @foreach($dialogues as $dialogue)
                            <a href="{{ $dialogue->frontendPath() }}">
                                <div class="relative flex items-center border rounded-xl px-4 py-2">
                                    @livewire('user.avatar', ['user' => $dialogue->partner(), 'size' => 8])
                                    <p class="ml-4">{{ $dialogue->partnerUsername }}</p>

                                    @if($dialogue->hasUnread())
                                        <x-radar-ping/>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="my-4">
                        {{ $dialogues->links() }}
                    </div>
                </div>
            @else
                <p class="mt-4">
                    {{ __('You have no dialogues yet.') }}
                </p>
            @endif
        </div>
    </div>
</x-layouts.cabinet>
