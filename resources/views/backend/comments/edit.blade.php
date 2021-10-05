<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Edit comment') }}</h1>
        <a href="{{ route('adm.comments.index') }}">
            <x-form.primary-button>{{ __('All comments') }}</x-form.primary-button>
        </a>
    </div>
    <form action="{{ route('adm.comments.update', $comment) }}" method="post" class="mt-4">
        @csrf
        @method('patch')
        @include('backend.comments._form')

        <div class="mt-6">
            <x-form.primary-button type="submit">{{ __('Update') }}</x-form.primary-button>
        </div>
    </form>
</x-layouts.back>
