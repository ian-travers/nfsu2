<a
    {{ $attributes->merge(['class' => 'block px-4 py-2 text-sm text-blue-200 hover:bg-gray-700 hover:text-blue-100']) }}
    role="menuitem"
>
    {{ $slot }}
</a>

