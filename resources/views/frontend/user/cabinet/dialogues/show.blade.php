@php /** @var \App\Models\Conversation\Dialogue $dialogue */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-5">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-semibold tracking-wide">{{ __('Your private dialogue with :partner', ['partner' => $dialogue->partnerUsername]) }}</h1>
            </div>
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col-reverse  overflow-y-auto border border-gray-400 rounded-xl h-96 px-4">
                    @foreach($dialogue->messages as $message)
                        <x-dialogue.message :message="$message"/>
                    @endforeach
                </div>
                <div class="mt-4">
                    <form action="{{ route('cabinet.dialogues.add-message', $dialogue->partnerUsername) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="">
                            <x-form.label for="body" value="{{ __('New message') }}"/>
                            <textarea
                                id="body"
                                rows="2"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-md"
                                name="body"
                            >{{ old('body') }}</textarea>
                            @error('body')<p class="text-red-500 mt-1 text-xs">{{ $message }}</p>@enderror
                        </div>
                        <div class="text-right mt-4">
                            <x-form.primary-button type="submit">{{ __('Send') }}</x-form.primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.cabinet>
