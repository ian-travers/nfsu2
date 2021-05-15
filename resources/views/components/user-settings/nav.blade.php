<div class="bg-white rounded-md sm:rounded-lg text-gray-900 px-4 py-2 sm:py-4">
    <div class="text-xl">
        {{ __('Account settings') }}
    </div>
    <nav class="mt-5 space-y-1">
        <x-user-settings.nav-item
            href="{{ route('settings.profile') }}"
            :active="request()->is('settings/profile')"
        >
            {{ __('Profile') }}
        </x-user-settings.nav-item>

        <x-user-settings.nav-item
            href="{{ route('settings.account') }}"
            :active="request()->is('settings/account')"
        >
            {{ __('Account') }}
        </x-user-settings.nav-item>
    </nav>
</div>

