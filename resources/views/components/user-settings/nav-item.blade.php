@props(['active'])

@php
    /** @var  bool $active */

    $classes = 'group flex items-center px-2 py-2 text-base font-medium rounded-md';

    $classes = $active ? $classes . ' bg-gray-100': $classes . 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
@endphp

<a
    {{ $attributes(['class' => $classes]) }}
    role="menuitem"
>
    {{ $slot }}
</a>

