<div class="bg-white shadow-lg rounded-md px-4 py-2 relative min-h-full">
    <h3 class="text-xl">{{ __('Season settings') }}</h3>
    <div class="mt-4 pb-2 border-b border-gray-200">
        <p>{{ __('Season ID') }}: {{ $index }}</p>
        <p>{{ __('Season status') }}: {{ $suspend ? __('Suspended') : __('Active') }}</p>
    </div>
    <div class="mt-2 space-y-2">
        <p class="text-xs text-gray-600">
            {{ __('Hint: You may suspend/resume season anytime. This allows racers to deny/allow to create tourneys.') }}
        </p>
        <p class="text-xs text-gray-600">
            {{ __('Hint: You may complete current season. New season will be created immediately.') }}
        </p>
    </div>
    <div class="mt-4 space-x-2 absolute right-4 bottom-2">
        @if($suspend)
            <x-form.success-button
                wire:click="resume"
            >
                {{ __('Resume') }}
            </x-form.success-button>
        @else
            <x-form.warning-button
                wire:click="suspend"
            >
                {{ __('Suspend') }}
            </x-form.warning-button>
        @endif
        <x-form.primary-button
            wire:click="complete"
        >
            {{ __('Complete') }}
        </x-form.primary-button>
    </div>
</div>
