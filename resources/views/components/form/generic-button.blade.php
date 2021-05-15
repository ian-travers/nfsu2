<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'items-center px-4 py-2 rounded-md font-semibold text-sm text-white tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
