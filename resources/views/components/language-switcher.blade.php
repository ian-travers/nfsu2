<div {{ $attributes }}>
    <x-dropdown alignment="right">
        <x-slot name="trigger">
            <div class="flex items-center">
                {{ language()->flag() }}
                <svg class="h-5 w-5 text-gray-400 ml-0.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </x-slot>
        @foreach(language()->allowed() as $code => $name)
            <x-dropdown-link href="{{ language()->back($code) }}" class="flex items-center">
                <img src="{{ asset('storage/assets/img/flags/'. language()->country($code) .'.png') }}" alt="{{ $name }}"
                     width="{{ config('language.flags.width') }}"/> &nbsp;
                {{ $name }}
            </x-dropdown-link>
        @endforeach
    </x-dropdown>
</div>
