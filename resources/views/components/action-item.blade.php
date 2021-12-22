@props(['action'])

<div class="bg-gray-500 bg-opacity-25 border border-blue-400 rounded-lg px-6 py-4">
    <p class="text-xs">
        {{ $action->created_at->isoFormat('LL') }}
    </p>
    <p class="mt-2">
        {{ $action->description }}
    </p>

</div>
