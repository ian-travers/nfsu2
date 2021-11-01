@php /** @var \App\Models\User $user */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your cabinet') }}</h1>
                <p>
                    <span>{{ __('Here you can manage your household.') }}</span>
                    @if($user->isRacer())
                        <span>{{ __('Since you are a racer you may create a tourney.') }}</span>
                    @endif
                </p>
            </div>
            <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-4">
                <a href="{{ route('cabinet.tourneys.index') }}">
                    <div class="transition-colors duration-300 hover:bg-blue-100 border border-blue-400 border-opacity-50 hover:border-opacity-75 rounded sm:rounded-md py-3">
                        <h3 class="font-medium text-xl text-center">{{ __('Your tourneys') }}: {{ $user->tourneys_count }}</h3>
                    </div>
                </a>
                <a href="{{ route('cabinet.posts.index') }}">
                    <div class="transition-colors duration-300 hover:bg-blue-100 border border-blue-400 border-opacity-50 hover:border-opacity-75 rounded sm:rounded-md py-3">
                        <h3 class="font-medium text-xl text-center">{{ __('Your posts') }}: {{ $user->posts_count }}</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-layouts.cabinet>
