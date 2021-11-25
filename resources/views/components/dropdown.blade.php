@props(['alignment' => 'left', 'width' => 'default'])

@php
    $alignmentClasses = [
        'left' => '',
        'right' => '-right-1',
    ];

    $widthClasses = [
        'narrower' => 'w-36',
        'default' => 'w-48',
        'wider' => 'w-60'
    ];
@endphp

<div
    x-data="{ isOpen: false }"
    class="relative"
>
    <div @click="isOpen = !isOpen" {{ $attributes(['class' => 'flex items-center']) }}>
        {{ $trigger }}
    </div>
    <div
        style="display: none"
        x-show="isOpen"
        @keydown.escape.window="isOpen = false"
        @click.away="isOpen = false"
        x-transition:enter="transition ease-out duration-150 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150 transform"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="{{ $alignmentClasses[$alignment] }} mt-2 absolute {{ $widthClasses[$width] }} z-10 rounded-md border border-gray-700 py-1 bg-nfsu-color ring-1 ring-white ring-opacity-20"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="user-menu"
    >
        {{ $slot }}
    </div>
</div>


