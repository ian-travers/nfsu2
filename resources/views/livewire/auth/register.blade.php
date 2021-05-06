<div>
    <div class="max-w-screen-lg mx-auto my-2 sm:my-8">
        <div class="w-12 sm:w-24 mx-auto mb-2 sm:mb-8">
            <img
                class="w-full border-4 border-blue-400 rounded-full"
                src="{{ asset('storage/1.png') }}"
                alt="green"
            >
        </div>
        <div class="flex-1 mx-auto text-blue-400 text-center px-2 md:px-8">
            <div class="text-2xl font-light mb-1">
                {{ __("I'm sorry, but if you not a fan of Need for Speed Underground,") }}
            </div>
            <div class="text-2xl font-light">
                {{ __("what are you doing here!?") }}
            </div>
            <div class="italic mt-6">~ newbie {{ __('(Creator of NFSU Cup)') }}</div>
        </div>
    </div>

    {{-- Register form--}}
    <div
        class="bg-gray-50 text-gray-900 md:max-w-screen-sm mx-6 md:mx-auto rounded-md md:rounded-lg p-6"
    >
        <p class="text-sm text-gray-400 text-center tracking-widest">{{ __('Register NFSU Cup') }}</p>
        <p class="text-3xl text-center my-1">{{ __('Create your account') }}</p>

        <div class="my-2 md:my-6 space-y-3 md:space-y-6">
            <div class="relative">
                <x-form.label for="username" value="{{ __('Username') }}"/>
                <x-form.input
                    wire:model.lazy="username"
                    id="username"
                    class="block mt-1 w-full"
                    type="text"
                    name="username"
                    :value="old('username')"
                    autofocus
                    autocomplete="username"
                />

                @error('username')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div class="relative">
                <x-form.label for="email" value="Email"/>
                <x-form.input
                    wire:model.lazy="email"
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    autocomplete="email"
                />

                @error('email')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>
            <div class="relative">
                <x-form.label for="password" value="{{ __('Password') }}"/>
                <x-form.input
                    wire:model.lazy="password"
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                />

                @error('password')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="#"
                >
                    {{ __('Already registered?') }}
                </a>

                <x-form.button
                    class="ml-8 text-center"
                    wire:click="submit"
                >
                    {{ __('Register') }}
                </x-form.button>
            </div>
        </div>

    </div> {{-- End of Register form--}}
</div>
