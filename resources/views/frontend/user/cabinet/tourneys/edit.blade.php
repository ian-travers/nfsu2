<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Edit tourney') }}</h1>
                <a href="{{ route('cabinet.tourneys.index') }}">
                    <x-form.primary-button>{{ __('Your tourneys') }}</x-form.primary-button>
                </a>
            </div>
            <form action="{{ route('cabinet.tourneys.update', $tourney) }}" method="post" class="mt-4">
                @csrf
                @method('patch')
                @include('frontend.user.cabinet.tourneys._form')

                <div class="mt-4">
                    <x-form.primary-button type="submit">{{ __('Update') }}</x-form.primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.cabinet>
