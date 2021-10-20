<x-layouts.front>
    <div class="max-w-screen-xl mx-auto py-6">
        <div>
            I'm here
        </div>
        <div>
            Здесь ща
        </div>
        @auth
            <div class="text-2xl">
                You are logged in now
            </div>
        @endauth
    </div>

    <div class="flex space-x-10 m-8">
        <div class=" border border-green-500 w-1/2">
            <x-rich-editor class="bg-nfsu-color w-full" rows="5"/>
        </div>
        <div class="p-8 border border-red-500 w-1/2">
            <x-rich-editor class="bg-nfsu-color w-full" mode="full" id="full-rich"/>
        </div>
    </div>
</x-layouts.front>
