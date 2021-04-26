@props(['route' => ''])

@php
    /** @var string $route */
    $classes = request()->routeIs($route) ? 'bg-gray-900 text-white' : 'text-blue-200'
@endphp

<a
    href="{{ $route != '#' ? route($route) : $route }}"
    {{ $attributes->merge(['class' => 'hover:bg-gray-700 hover:text-blue-100 px-3 py-2 rounded-md font-medium block ' . $classes ]) }}
    role="menuitem"
>
    {{ $slot }}
</a>

