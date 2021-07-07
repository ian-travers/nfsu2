@props(['disabled' => false])

@php
/** @var $disabled bool */
    $classes = $disabled
        ? 'items-center px-4 py-2 rounded-md font-semibold text-sm text-white tracking-widest disabled:opacity-25'
        : 'items-center px-4 py-2 rounded-md font-semibold text-sm text-white tracking-widest transition ease-in-out duration-150'
@endphp

<button
    {{ $disabled ? 'disabled' : '' }} {{ $attributes(['type' => 'button', 'class' => $classes]) }}>
    {{ $slot }}
</button>
