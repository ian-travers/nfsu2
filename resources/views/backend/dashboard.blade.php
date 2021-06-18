<x-layouts.back title="{{ $title }}">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-wide">{{ __('Applications settings') }}</h1>
    </div>
    <div class="grid md:grid-cols-3 lg:grid-cols-3 gap-4">
        <div class="bg-white shadow-lg rounded-md px-4 py-2">
            <h3 class="text-xl">{{ __('Racer test settings') }}</h3>
            <form action="{{ route('adm.settings.update-racer-test-settings') }}" method="post" class="my-4">
                @csrf
                @method('patch')
                <div class="mt-4">
                    <x-form.label for="questions_count">{{ __('Questions count') }}</x-form.label>
                    <x-form.input
                        id="questions_count"
                        class="block mt-1 w-full"
                        type="number"
                        name="questions_count"
                        value="{{ old('questions_count', $racerTestSettings->questions_count) }}"
                        autofocus
                        autocomplete="questions_count"
                    />
                    @error('questions_count')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                </div>
                <div class="mt-4">
                    <x-form.label for="allowed_errors_count">{{ __('Allowed errors count') }}</x-form.label>
                    <x-form.input
                        id="allowed_errors_count"
                        class="block mt-1 w-full"
                        type="number"
                        name="allowed_errors_count"
                        value="{{ old('allowed_errors_count', $racerTestSettings->allowed_errors_count) }}"
                        autocomplete="allowed_errors_count"
                    />
                    @error('allowed_errors_count')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                </div>
                <div class="mt-4 flex justify-end">
                    <x-form.primary-button type="submit">{{ __('Save') }}</x-form.primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.back>
