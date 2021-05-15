<x-layouts.front>
    <div class="bg-gray-50 text-gray-900 md:max-w-screen-sm mx-6 md:mx-auto rounded-md md:rounded-lg p-6 mt-8 md:mt-24">
        <p class="text-sm text-gray-400 text-center tracking-widest">{{ __("Restore access to NFSU Cup") }}</p>
        <p class="my-2 text-gray-700 text-lg">
            {{ __('Forgot your password? No problem. Just let me know your email address and I will email you a password reset link that will allow you to choose a new one.') }}
        </p>
        <form class="mt-4" action="{{ route('password.email') }}" method="post">
            @csrf
            <x-form.label for="email">Email</x-form.label>
            <x-form.input
                id="email"
                class="block mt-1 w-full"
                type="text"
                name="email"
                :value="old('email')"
                autofocus required autocomplete="email"
            />
            @error('email')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
            <div class="flex justify-end mt-4">
                <x-form.button type="submit">
                    {{ __('Email password reset link') }}
                </x-form.button>
            </div>
        </form>
    </div>
</x-layouts.front>

