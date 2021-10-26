<x-layouts.front>
    <div class="max-w-screen-xl mx-auto py-6">
        @auth
            <div class="text-2xl">
                You are logged in now
            </div>
        @endauth
    </div>

    <div class="p-8 border border-red-500 w-1/2">
        <x-rich-editor
            class="w-full"
        />
    </div>
</x-layouts.front>
