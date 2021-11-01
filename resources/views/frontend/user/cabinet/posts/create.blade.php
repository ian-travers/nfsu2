<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Create post') }}</h1>
                <a href="{{ route('cabinet.posts.index') }}">
                    <x-form.primary-button>{{ __('All posts') }}</x-form.primary-button>
                </a>
            </div>
            <form action="{{ route('cabinet.posts.store') }}" method="post" class="mt-4" enctype="multipart/form-data">
                @csrf
                @include('backend.posts._form')

                <div class="mt-6">
                    <x-form.primary-button type="submit">{{ __('Create') }}</x-form.primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.cabinet>
