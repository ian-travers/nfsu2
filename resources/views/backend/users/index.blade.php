<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl">{{ __('Users') }}</h1>
        <a href="{{ route('adm.users.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>
</x-layouts.back>
