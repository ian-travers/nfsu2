<div class="bg-white shadow-lg rounded-md px-4 py-2">
    <h3 class="text-xl">{{ __('Site points system') }}</h3>
    <div class="border rounded-lg pt-2 pb-4 px-4 mt-4">
        <h4 class="text-lg text-center font-medium">{{ __('Tourney place') }}</h4>
        <div class="flex items-center justify-center space-x-2">
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

        <h4 class="text-lg text-center font-medium mt-6">{{ __('Activity') }}</h4>
        <div class="flex items-center justify-center space-x-2">
            <div>
                <x-form.label for="competition" class="text-center">{{ __('Competition') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="competition"
                    id="competition"
                    class="block mt-1 w-full"
                    type="number"
                    name="competition"
                    :value="old('competition')"
                    autocomplete="competition"
                />
                @error('competition')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="comment" class="text-center">{{ __('Comment') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="comment"
                    id="comment"
                    class="block mt-1 w-full"
                    type="number"
                    name="comment"
                    :value="old('comment')"
                    autocomplete="comment"
                />
                @error('comment')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="like_dislike" class="text-center">{{ __('Like | Dislike') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="likeDislike"
                    id="like_dislike"
                    class="block mt-1 w-full"
                    type="number"
                    name="like_dislike"
                    :value="old('like_dislike')"
                    autocomplete="like_dislike"
                />
                @error('likeDislike')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="pass_racer_test" class="text-center">{{ __('Become a racer') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="passRacerTest"
                    id="pass_racer_test"
                    class="block mt-1 w-full"
                    type="number"
                    name="pass_racer_test"
                    :value="old('pass_racer_test')"
                    autocomplete="pass_racer_test"
                />
                @error('passRacerTest')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="join_team" class="text-center">{{ __('Join the team') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="joinTeam"
                    id="join_team"
                    class="block mt-1 w-full"
                    type="number"
                    name="join_team"
                    :value="old('join_team')"
                    autocomplete="join_team"
                />
                @error('joinTeam')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>

        <h4 class="text-lg text-center font-medium mt-6">{{ __('Creation') }}</h4>
        <div class="flex items-center justify-center space-x-2">
            <div>
                <x-form.label for="create_team" class="text-center">{{ __('Create a team') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="createTeam"
                    id="create_team"
                    class="block mt-1 w-full"
                    type="number"
                    name="create_team"
                    :value="old('create_team')"
                    autocomplete="create_team"
                />
                @error('createTeam')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="create_tourney" class="text-center">{{ __('New tourney') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="createTourney"
                    id="create_tourney"
                    class="block mt-1 w-full"
                    type="number"
                    name="create_tourney"
                    :value="old('create_tourney')"
                    autocomplete="create_tourney"
                />
                @error('createTourney')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <x-form.label for="post" class="text-center">{{ __('Publish post') }}</x-form.label>
                <x-form.input
                    wire:model.lazy="post"
                    id="post"
                    class="block mt-1 w-full"
                    type="number"
                    name="post"
                    :value="old('post')"
                    autocomplete="post"
                />
                @error('post')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
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

