<div>
    <table class="divide-y divide-gray-200 border w-full">
        <thead class="bg-gray-50">
        <tr>
            <x-table.th>#</x-table.th>
            <x-table.th>{{ __('Username') }}</x-table.th>
            <x-table.th>{{ __('Place') }}</x-table.th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($racers as $key => $racer)
            <tr>
                <td class="text-center px-2 py-1">{{ $racer['order'] }}</td>
                <td class="px-2 py-1">{{ $racer['racer_username'] }}</td>
                <td class="text-right px-2 py-1">
                    <input
                        type="number" min="0" max="4"
                        wire:model.lazy="resultsForm.{{ $key }}.place"
                        class="rounded-md w-16"
                    />
                    <input
                        type="hidden"
                        wire:model.lazy="resultsForm.{{ $key }}.id"
                    />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @error("resultsForm.*.place")<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror

    <div class="flex justify-end mt-4 space-x-2">
        <x-form.secondary-button onclick="toggleModal()">
            {{ __('Cancel') }}
        </x-form.secondary-button>
        <x-form.primary-button wire:click="submit">
            {{ __('Update') }}
        </x-form.primary-button>
    </div>
</div>
