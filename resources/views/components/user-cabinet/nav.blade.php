<div class="bg-white rounded-md sm:rounded-lg text-gray-900 px-4 py-2 sm:py-4">
    <div class="text-xl">
        {{ __('User cabinet') }}
    </div>
    <nav class="mt-5 space-y-1">
        <x-navs.vertical.nav-item
            href="{{ route('cabinet.index') }}"
            :active="request()->is('cabinet/index')"
        >
            {{ __('Overall info') }}
        </x-navs.vertical.nav-item>
    </nav>
</div>

