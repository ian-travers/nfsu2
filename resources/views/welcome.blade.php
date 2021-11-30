<x-layouts.front>
    <!-- 3 column wrapper -->
    <div class="flex-grow w-full max-w-screen-2xl text-blue-400 mx-auto xl:px-8 lg:flex">
        <div class="flex-1 min-w-0 xl:flex">
            <div class="xl:flex-shrink-0 xl:w-2/3">
                <div class="xl:h-96 px-4 py-6 xl:px-0">
                    <div class="xl:h-full flex flex-col justify-center">
                        @auth
                            You are logged in
                        @else
                            <div class="flex flex-col justify-center px-4">
                                <p class="text-3xl lg:text-5xl mb-8">Let's play NFS Underground</p>
                                <p class="text-xl lg:text-2xl">
                                    The simple way to get online racing. You can play here with your friends and
                                    other people.</p>
                                <p class="text-xl lg:text-2xl mt-2">
                                    Hey! And if a tourney is scheduled, don't forget to take part in it.
                                </p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="lg:min-w-0 lg:flex-1">
                <div class="xl:h-96 py-6 px-4">
                    <div
                        class="text-sm lg:text-base xl:h-full flex flex-col justify-center space-y-4 xl:border-l xl:border-blue-400 px-4">
                        <span class="inline-block">{{ __('Start racing online now.') }}</span>
                        <span
                            class="inline-block">{{ __('You will find everything you need for this in the downloads section.') }}</span>
                        <span
                            class="inline-block">{{ __('And to make it more interesting for you after registration, you can take part in competitions.') }}</span>
                        <span
                            class="inline-block">{{ __('And if you then pass the racer test, you will be able to take part in the tourneys.') }}</span>
                        <div class="text-center">
                            <a
                                href="{{ route('register') }}"
                                class="block mt-8"
                            >
                                <x-form.primary-button>{{ __('Register') }}</x-form.primary-button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 xl:pr-0">
            <div class="py-6 lg:w-64">
                <!-- Start right column area -->
                <div class="lg:border-l lg:border-blue-400">
                    <div class="text-center lg:text-right">
                        <p class="text-base lg:text-xl">{{ __('Recent news') }}</p>
                    </div>
                    @if($news->count())
                        @foreach($news as $newsitem)
                            <article class="py-3 px-4">
                                <div class="flex flex-col justify-between">
                                    <header>
                                        <x-link href="{{ route('news.view', $newsitem) }}">
                                            {{ $newsitem->title }}
                                        </x-link>
                                        <span class="mt-1 block text-gray-400 text-xs">
                                        <time>{{ $newsitem->created_at->isoFormat('lll') }}</time>
                                    </span>
                                    </header>
                                    <div class="text-sm mt-3">
                                        {!! Str::words($newsitem->body, 10) !!}
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <div class="text-sm py-3 px-4">
                            {{ __('There is no news yet.') }}
                        </div>
                    @endif
                </div>
                <!-- End right column area -->
            </div>
        </div>
    </div>
</x-layouts.front>
