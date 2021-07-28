<div class="bg-white shadow-lg rounded-md px-4 py-2">
    <h3 class="text-xl">{{ __('Racer test settings') }}</h3>
    <div class="mt-4">
        <x-form.label for="questions_count">{{ __('Questions count') }}</x-form.label>
        <x-form.input
            wire:model.lazy="questionsCount"
            id="questions_count"
            class="block mt-1 w-full"
            type="number"
            name="questions_count"
            :value="old('questions_count')"
            autocomplete="questions_count"
        />
        @error('questionsCount')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
    <div class="mt-4">
        <x-form.label for="allowed_errors_count">{{ __('Allowed errors count') }}</x-form.label>
        <x-form.input
            wire:model.lazy="allowedErrorsCount"
            id="allowed_errors_count"
            class="block mt-1 w-full"
            type="number"
            name="allowed_errors_count"
            :value="old('allowed_errors_count')"
            autocomplete="allowed_errors_count"
        />
        @error('allowedErrorsCount')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
    </div>
    <div class="mt-4 flex justify-end ">
        <x-form.primary-button
            wire:click="submit"
        >
            {{ __('Save') }}
        </x-form.primary-button>
    </div>
</div>
