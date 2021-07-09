<div class="bg-white shadow-lg rounded-md px-4 py-2">
    <h3 class="text-xl">{{ __('Scoring system') }}</h3>
    <div class="border rounded-lg pt-2 pb-4 px-4 mt-4">
        <h4 class="text-lg text-center font-medium">{{ __('Tourney regular round') }}</h4>
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-form.label for="tourney_regular_first" class="text-center">{{ __('1st') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyRegularFirst"
                    id="tourney_regular_first"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_regular_first"
                    :value="old('tourney_regular_first')"
                    autofocus
                    autocomplete="tourney_regular_first"
                />
                @error('tourneyRegularFirst')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_regular_second" class="text-center">{{ __('2nd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyRegularSecond"
                    id="tourney_regular_second"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_regular_second"
                    :value="old('tourney_regular_second')"
                    autocomplete="tourney_regular_second"
                />
                @error('tourneyRegularSecond')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_regular_third" class="text-center">{{ __('3rd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyRegularThird"
                    id="tourney_regular_third"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_regular_third"
                    :value="old('tourney_regular_third')"
                    autocomplete="tourney_regular_third"
                />
                @error('tourneyRegularThird')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_regular_fourth" class="text-center">{{ __('4th') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyRegularFourth"
                    id="tourney_regular_fourth"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_regular_fourth"
                    :value="old('tourney_regular_fourth')"
                    autocomplete="tourney_regular_fourth"
                />
                @error('tourneyRegularFourth')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>
        <h4 class="text-lg text-center font-medium mt-6">{{ __('Tourney final round') }}</h4>
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-form.label for="tourney_final_first" class="text-center">{{ __('1st') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFinalFirst"
                    id="tourney_final_first"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_final_first"
                    :value="old('tourney_final_first')"
                    autofocus
                    autocomplete="tourney_final_first"
                />
                @error('tourneyFinalFirst')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_final_second" class="text-center">{{ __('2nd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFinalSecond"
                    id="tourney_final_second"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_final_second"
                    :value="old('tourney_final_second')"
                    autocomplete="tourney_final_second"
                />
                @error('tourneyFinalSecond')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_final_third" class="text-center">{{ __('3rd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFinalThird"
                    id="tourney_final_third"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_final_third"
                    :value="old('tourney_final_third')"
                    autocomplete="tourney_final_third"
                />
                @error('tourneyFinalThird')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_final_fourth" class="text-center">{{ __('4th') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFinalFourth"
                    id="tourney_final_fourth"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_final_fourth"
                    :value="old('tourney_final_fourth')"
                    autocomplete="tourney_final_fourth"
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
