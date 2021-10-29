<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('NFSU Cup Blog') }}</h2>
        @if($posts->total())
            <x-posts.grid :posts="$posts"/>
            <div class="mt-6">
                {{ $posts->links('vendor.pagination.frontend') }}
            </div>
        @else
            {{ __('There is no blog posts yet.') }}
        @endif
    </div>
</x-layouts.front>
