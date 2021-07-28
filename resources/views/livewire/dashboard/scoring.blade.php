<div class="bg-white shadow-lg rounded-md px-4 py-2">
    <h3 class="text-xl">{{ __('Scoring system') }}</h3>
    <div class="border rounded-lg pt-2 pb-4 px-4 mt-4">
        <h4 class="text-lg text-center font-medium">{{ __('Heat regular round') }}</h4>
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-form.label for="heat_regular_first" class="text-center">{{ __('1st') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatRegularFirst"
                    id="heat_regular_first"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_regular_first"
                    :value="old('heat_regular_first')"
                    autofocus
                    autocomplete="heat_regular_first"
                />
                @error('heatRegularFirst')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_regular_second" class="text-center">{{ __('2nd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatRegularSecond"
                    id="heat_regular_second"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_regular_second"
                    :value="old('heat_regular_second')"
                    autocomplete="heat_regular_second"
                />
                @error('heatRegularSecond')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_regular_third" class="text-center">{{ __('3rd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatRegularThird"
                    id="heat_regular_third"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_regular_third"
                    :value="old('heat_regular_third')"
                    autocomplete="heat_regular_third"
                />
                @error('heatRegularThird')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_regular_fourth" class="text-center">{{ __('4th') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatRegularFourth"
                    id="heat_regular_fourth"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_regular_fourth"
                    :value="old('heat_regular_fourth')"
                    autocomplete="heat_regular_fourth"
                />
                @error('heatRegularFourth')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>
        <h4 class="text-lg text-center font-medium mt-6">{{ __('Heat final round') }}</h4>
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-form.label for="heat_final_first" class="text-center">{{ __('1st') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatFinalFirst"
                    id="heat_final_first"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_final_first"
                    :value="old('heat_final_first')"
                    autocomplete="heat_final_first"
                />
                @error('heatFinalFirst')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_final_second" class="text-center">{{ __('2nd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatFinalSecond"
                    id="heat_final_second"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_final_second"
                    :value="old('heat_final_second')"
                    autocomplete="heat_final_second"
                />
                @error('heatFinalSecond')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_final_third" class="text-center">{{ __('3rd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatFinalThird"
                    id="heat_final_third"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_final_third"
                    :value="old('heat_final_third')"
                    autocomplete="heat_final_third"
                />
                @error('heatFinalThird')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="heat_final_fourth" class="text-center">{{ __('4th') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="heatFinalFourth"
                    id="heat_final_fourth"
                    class="block mt-1 w-full"
                    type="number"
                    name="heat_final_fourth"
                    :value="old('heat_final_fourth')"
                    autocomplete="heat_final_fourth"
                />
                @error('tourneyFinalFourth')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>


    <div class="mt-4 flex justify-end ">
        <x-form.primary-button
            wire:click="submit"
        >
            {{ __('Save') }}
        </x-form.primary-button>
    </div>
</div>
