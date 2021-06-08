@props(['active'])

@php
    /** @var bool $active */
    $classes = 'group flex items-center px-2 py-2 text-sm font-medium rounded-md';
    $classes .= $active ? ' bg-gray-100 text-gray-900' : ' text-gray-600 hover:bg-gray-50 hover:text-gray-900'
@endphp

<a
    {{ $attributes(['class' => $classes]) }}
    role="menuitem"
>
    {{ $slot }}
</a>
