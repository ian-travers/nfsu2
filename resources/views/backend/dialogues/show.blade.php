@php /** @var \App\Models\Conversation\Dialogue $dialogue */ @endphp

<x-layouts.back title="{{ $title }}">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold tracking-wide">
            {{ __('Dialogue') }}
            <span class="text-base font-normal tracking-normal">
                {{ $dialogue->initiator->username }} + {{ $dialogue->companion->username }}
            </span>
        </h1>
        <a href="{{ route('adm.dialogues.index') }}">
            <x-form.primary-button>{{ __('All dialogues') }}</x-form.primary-button>
        </a>
    </div>

    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col-reverse overflow-y-auto border border-gray-400 rounded-xl h-96 px-4">
            @foreach($dialogue->messages as $message)
                <x-dialogue.message :message="$message"/>
            @endforeach
        </div>
    </div>
</x-layouts.back>
