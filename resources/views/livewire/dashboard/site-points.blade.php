<div class="bg-white shadow-lg rounded-md px-4 py-2">
    <h3 class="text-xl">{{ __('Site points system') }}</h3>
    <div class="border rounded-lg pt-2 pb-4 px-4 mt-4">
        <h4 class="text-lg text-center font-medium">{{ __('Tourney place') }}</h4>
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-form.label for="tourney_first" class="text-center">{{ __('1st') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFirst"
                    id="tourney_first"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_first"
                    :value="old('tourney_first')"
                    autofocus
                    autocomplete="tourney_first"
                />
                @error('tourneyFirst')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_second" class="text-center">{{ __('2nd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneySecond"
                    id="tourney_second"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_second"
                    :value="old('tourney_second')"
                    autocomplete="tourney_second"
                />
                @error('tourneySecond')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_third" class="text-center">{{ __('3rd') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyThird"
                    id="tourney_third"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_third"
                    :value="old('tourney_third')"
                    autocomplete="tourney_third"
                />
                @error('tourneyThird')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_fourth" class="text-center">{{ __('4th') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFourth"
                    id="tourney_fourth"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_fourth"
                    :value="old('tourney_fourth')"
                    autocomplete="tourney_fourth"
                />
                @error('tourneyFourth')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="tourney_fifth_plus" class="text-center">{{ __('5th+') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="tourneyFifthPlus"
                    id="tourney_fifth_plus"
                    class="block mt-1 w-full"
                    type="number"
                    name="tourney_fifth_plus"
                    :value="old('tourney_fifth_plus')"
                    autocomplete="tourney_fifth_plus"
                />
                @error('tourneyFifthPlus')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
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

