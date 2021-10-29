<footer class="bg-nfsu-color border-t border-gray-600 text-blue-400" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-screen-2xl mx-auto p-4 sm:px-6 lg:p-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 xl:col-span-1">
                <div class="flex items-center justify-center xl:justify-start space-x-4">
                    <x-logo></x-logo>
                    <p class="text-blue-400">
                        The simplest way to get online<br>Need for Speed Underground.
                    </p>
                </div>

                <div class="flex justify-center xl:justify-start space-x-6">
                    <x-link href="#">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </x-link>
                    <x-link href="#">
                        <span class="sr-only">Youtube</span>
                        <svg class="h-6 w-6" fill="currentColor" aria-hidden="true" viewBox="0 0 50 50">
                            <path
                                d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z"/>
                        </svg>
                    </x-link>
                    <x-link href="#">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                        </svg>
                    </x-link>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">
                            {{ __('Information') }}
                        </h3>
                        <ul role="list" class="mt-4 space-y-1">
                            <li><x-link href="{{ route('page', 'tourneys') }}">{{ __('Tourneys') }}</x-link></li>
                            <li><x-link href="{{ route('page', 'competitions') }}">{{ __('Competitions') }}</x-link></li>
                            <li><x-link href="{{ route('page', 'nfsu-cup') }}">NFSU Cup</x-link></li>
                            <li><x-link href="{{ route('page', 'nfsu-server') }}">{{ __('NFSU Server') }}</x-link></li>
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">
                            {{ __('Help center') }}
                        </h3>
                        <ul role="list" class="mt-4 space-y-1">
                            <li><x-link href="{{ route('rules') }}">{{ __('Rules') }}</x-link></li>

                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                                    Documentation
                                </a>
                            </li>

                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                                    Guides
                                </a>
                            </li>

                            <li>
                                <a href="#" class="text-base text-gray-500 hover:text-gray-900">
                                    API Status
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">
                            {{ __('Downloads') }}
                        </h3>
                        <ul role="list" class="mt-4 space-y-1">
                            <li><x-link href="{{ route('downloads', 'nfsu') }}">{{ __('NFS Underground') }}</x-link></li>
                            <li><x-link href="{{ route('downloads', 'nfsu-client') }}">{{ __('NFSU Client') }}</x-link></li>
                            <li><x-link href="{{ route('downloads', 'nfsu-save') }}">{{ __('NFSU Save') }}</x-link></li>
                            <li><x-link href="{{ route('downloads', 'nfsu-save-patcher') }}">{{ __('NFSU Save Patcher') }}</x-link></li>
                        </ul>
                    </div>
                    <div class="mt-12 md:mt-0">
                        <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase">
                            {{ __('Archive') }}
                        </h3>
                        <ul role="list" class="mt-4 space-y-1">
                            <li><x-link href="{{ route('news.index') }}">{{ __('News') }}</x-link></li>
                            <li><x-link href="{{ route('blog.index') }}">{{ __('Blog') }}</x-link></li>
                            <li><x-link href="{{ route('seasons-archive.index') }}">{{ __('Seasons') }}</x-link></li>
                            <li><x-link href="{{ route('tourneys.archive') }}">{{ __('Tourneys') }}</x-link></li>
                            <li><x-link href="{{ route('competitions.archive') }}">{{ __('Competitions') }}</x-link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
