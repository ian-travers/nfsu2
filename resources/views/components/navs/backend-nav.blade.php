<nav class="flex-1 px-2 bg-white space-y-1">
    <div class="flex justify-center mb-3">
        {{ __('Dashboard') }}
    </div>
    <x-navs.vertical.nav-item
        href="{{ route('adm.competitions.index') }}"
        :active="$controller == 'CompetitionsController'"
    >
        {{ __('Competitions') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.news.index') }}"
        :active="$controller == 'NewsController'"
    >
        {{ __('News') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.posts.index') }}"
        :active="$controller == 'PostsController'"
    >
        {{ __('Blog posts') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.users.index') }}"
        :active="$controller == 'UsersController'"
    >
        {{ __('Users') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.quiz.question.index') }}"
        :active="$controller == 'QuestionsController' || $controller == 'AnswersController'"
    >
        {{ __('Quiz') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.dialogues.index') }}"
        :active="$controller == 'DialoguesController'"
    >
        {{ __('Dialogues') }}
    </x-navs.vertical.nav-item>
    <x-navs.vertical.nav-item
        href="{{ route('adm.comments.index') }}"
        :active="$controller == 'CommentsController'"
    >
        <div class="relative inline-flex">
            {{ __('Comments') }}
            <p class="absolute rounded-md text-xs text-gray-50 bg-yellow-500 transform -rotate-12 -top-1 -right-8 px-1 py-0.5">raw</p>
        </div>
    </x-navs.vertical.nav-item>
    <div class="border-t border-gray-300 mt-4 h-4">&nbsp;</div>
    <x-navs.vertical.nav-item
        href="{{ route('adm.dashboard') }}"
        :active="$controller == 'DashboardController'"
    >
        {{ __('Application settings') }}
    </x-navs.vertical.nav-item>
</nav>
