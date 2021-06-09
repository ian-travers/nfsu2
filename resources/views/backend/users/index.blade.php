<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Users') }}</h1>
        <a href="{{ route('adm.users.create') }}">
            <x-form.primary-button>{{ __('Create') }}</x-form.primary-button>
        </a>
    </div>

    <div class="mt-4">
        @include('backend.users._table')
    </div>

    <!--Modal change password -->
    @include('backend.users._modalChangePassword')
</x-layouts.back>
