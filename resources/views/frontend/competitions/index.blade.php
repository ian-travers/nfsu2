@php /** @var \App\Models\Competition\ $competition */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl space-y-4">
        <x-competitions.active-card :competition="$competition"/>
        <div class="text-center text-lg mt-4">{{ __('Competition archive') }}</div>
        <x-competitions.archive :competitions="$competitions"/>
    </div>
</x-layouts.front>
