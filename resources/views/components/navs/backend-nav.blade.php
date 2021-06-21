<nav class="flex-1 px-2 bg-white space-y-1">
    <div class="flex justify-center mb-3">
        {{ __('Dashboard') }}
    </div>
    <x-navs.backend-link
        href="{{ route('adm.dashboard') }}"
        :active="$controller == 'DashboardController'"
    >
        {{ __('Application settings') }}
    </x-navs.backend-link>
    <x-navs.backend-link
        href="{{ route('adm.users.index') }}"
        :active="$controller == 'UsersController'"
    >
        {{ __('Users') }}
    </x-navs.backend-link>
    <x-navs.backend-link
        href="{{ route('adm.quiz.question.index') }}"
        :active="$controller == 'QuestionsController' || $controller == 'AnswersController'"
    >
        {{ __('Quiz') }}
    </x-navs.backend-link>
</nav>
