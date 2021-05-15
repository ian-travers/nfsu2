<x-layouts.front>
    <div class="bg-gray-50 text-gray-900 md:max-w-screen-sm mx-6 md:mx-auto rounded-md md:rounded-lg p-6 mt-8 md:mt-24">
        <p class="text-sm text-gray-400 text-center tracking-widest">{{ __("Reset password to NFSU Cup") }}</p>
        <x-validation-errors/>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mt-4">
                <x-form.label for="email" value="Email" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-form.label for="password" value="{{ __('Password') }}" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-form.primary-button type="submit">
                    {{ __('Reset Password') }}
                </x-form.primary-button>
            </div>
        </form>
    </div>
</x-layouts.front>

