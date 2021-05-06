<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'items-center px-4 py-2 bg-blue-500 border rounded-md font-semibold text-sm text-white tracking-widest hover:bg-blue-700 active:bg-blue-900 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

