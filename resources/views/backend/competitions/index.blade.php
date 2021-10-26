<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Competitions') }}</h1>
        <a href="{{ route('adm.competitions.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>

    @if($competitions->count())
        <div class="mt-4">
            @include('backend.competitions._table')

            <div class="my-4">
                {{ $competitions->links() }}
            </div>
        </div>
    @else
        <p class="mt-4">
            {{ __('There is no competitions yet.') }}
        </p>
    @endif
</x-layouts.back>
