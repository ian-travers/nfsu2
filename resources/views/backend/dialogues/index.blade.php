@php /** @var \App\Models\Conversation\Dialogue $dialogue */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="bg-white px-4 py-5">
        <div class="flex">
            <h1 class="text-2xl font-semibold tracking-wide">{{ __('Dialogues') }}</h1>
        </div>

        @if($dialogues->count())
            <div class="mt-4">
                <div
                    class="grid grid-cols-2 gap-2 md:grid md:grid-cols-3 md:gap-3 lg:grid lg:grid-cols-4 lg:gap-4 xl:grid xl:grid-cols-6 xl:gap-4">
                    @foreach($dialogues as $dialogue)
                        <div class="border rounded-xl">
                            <a href="{{ $dialogue->backendPath() }}">
                                <div class="relative flex items-center px-4 py-2">
                                    @livewire('user.avatar', ['user' => $dialogue->initiator, 'size' => 8])
                                    <p class="ml-4">{{ $dialogue->initiator->username }}</p>
                                </div>
                                <div class="relative flex items-center justify-end px-4 py-2">
                                    @livewire('user.avatar', ['user' => $dialogue->companion, 'size' => 8])
                                    <p class="ml-4">{{ $dialogue->companion->username }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="my-4">
                    {{ $dialogues->links() }}
                </div>
            </div>
        @else
            <p class="mt-4">
                {{ __('There is no dialogues.') }}
            </p>
        @endif
    </div>
</x-layouts.back>
