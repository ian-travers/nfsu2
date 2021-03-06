<div class="w-full flex items-center justify-between">
    <div class="px-4">
        <p class="text-2xl sm:text-3xl lg:text-4xl text-white font-semibold">{{ $username }}</p>
        <p class="text-xs sm:text-sm lg:text-md text-gray-400">{{ __('Your personal account') }}</p>
    </div>
    <a href="{{ route('public-profile', auth()->user()) }}">
        <x-form.primary-button class="mr-4" href="">{{ __('Go to your public profile') }}</x-form.primary-button>
    </a>
</div>

