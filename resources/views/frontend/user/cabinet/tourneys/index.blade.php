<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your tourneys') }}</h1>
                @if($suspend)
                    <p class="text-gray-500">{{ __('Season is suspended.') }}</p>
                @else
                    <a href="{{ route('cabinet.tourneys.create') }}">
                        <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
                    </a>
                @endif
            </div>

            @if($tourneys->count())
                <div class="mt-4">
                    @include('frontend.user.cabinet.tourneys._table')

                    <div class="my-4">
                        {{ $tourneys->links() }}
                    </div>
                </div>
            @else
                <p class="mt-4">
                    {{ __('There is no tourneys yet.') }}
                </p>
            @endif
        </div>
    </div>
</x-layouts.cabinet>
