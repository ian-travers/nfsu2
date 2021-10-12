<div id="reply-form" x-data x-show="$wire.isShow" style="display: none">
    <div class="flex items-center space-x-4">
        @livewire('user.avatar', ['size' => 6])
        <div class="flex-1">
            <textarea
                wire:model.defer="body"
                class="bg-transparent text-blue-400 border-t-0 border-l-0 border-r-0 w-full focus:ring-0 h-14 overflow-y-hidden"
                name="body"
                id="body"
                placeholder="{{ __('Add a public reply...') }}"
            >{{ $body }}</textarea>
            <p class="text-ms text-gray-400">{{ $parentId ?: 'zero' }}</p>
            @error('body')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
        </div>
    </div>
    <div
        class="flex justify-end space-x-4 mt-2"
    >
        <x-form.secondary-button
            wire:click="hide"
        >
            {{ __('Cancel') }}
        </x-form.secondary-button>
        <x-form.primary-button
            wire:click="submitForm"
        >
            {{ __('Reply') }}
        </x-form.primary-button>
    </div>
</div>
