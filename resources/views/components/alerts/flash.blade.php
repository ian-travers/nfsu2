@props([
    'type' => 'success',
    'colors' => [
        'success' => 'bg-green-600',
        'info' => 'bg-blue-600',
        'warning' => 'bg-yellow-600',
        'error' => 'bg-red-600',
    ]
])

<div class="alert-flash fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm z-10">
    <input type="checkbox" class="hidden" id="alertflash">

    <label {{ $attributes->merge(['class' => "{$colors[$type]} close cursor-pointer flex items-start justify-between w-full p-2 h-24 rounded shadow-lg text-white"]) }} title="{{ __('Close') }}" for="alertflash">

        {{ $slot }}

        <svg class="fill-current text-white" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
    </label>
</div>


