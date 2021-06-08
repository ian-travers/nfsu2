<nav class="flex-1 px-2 bg-white space-y-1">
    <x-navs.backend-link
        href="{{ route('adm.dashboard') }}"
        :active="$controller == 'DashboardController'"
    >
        {{ __('Dashboard') }}
    </x-navs.backend-link>
    <x-navs.backend-link
        href="{{ route('adm.users.index') }}"
        :active="$controller == 'UsersController'"
    >
        {{ __('Users') }}
    </x-navs.backend-link>
</nav>
