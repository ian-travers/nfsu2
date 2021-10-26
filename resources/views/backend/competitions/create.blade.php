<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('New competition') }}</h1>
        <a href="{{ route('adm.competitions.index') }}">
            <x-form.primary-button>{{ __('All competitions') }}</x-form.primary-button>
        </a>
    </div>
    <form action="{{ route('adm.competitions.store') }}" method="post" class="mt-4">
        @csrf
        @include('backend.competitions._form')

        <div class="mt-6">
            <x-form.primary-button type="submit">{{ __('Create') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>
