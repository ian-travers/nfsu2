<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'items-center px-4 py-2 bg-blue-500 rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-700 focus:bg-blue-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

