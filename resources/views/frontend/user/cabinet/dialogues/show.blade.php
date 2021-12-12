@php /** @var \App\Models\Conversation\Dialogue $dialogue */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your private dialogue with :partner', ['partner' => $dialogue->partner()->username]) }}</h1>
            </div>
            <div class="flex flex-col-reverse max-w-5xl overflow-y-auto border border-gray-400 rounded-xl h-96 mx-auto px-4">
                @foreach($dialogue->messages as $message)
                    <x-dialogue.message :message="$message"/>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.cabinet>
