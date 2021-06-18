@php /** @var \App\Models\Quiz\Question $question */ @endphp

<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Racer test') }}</h2>
        <p class="leading-5 text-lg">{{ __('This test will find out how well you know the Rules of the NFSU Cup. When you pass this test you will be promoted to racer and will be able to participate in tourneys.') }}</p>

        <form action="{{ route('tests.racer.check') }}" method="post">
            <div class="md:grid md:grid-cols-2 md:gap-3 mt-4 md:mt-8">
                @csrf
                @foreach($questions as $question)
                    <div class="py-6 px-5 border border-blue-400 rounded-md">
                        <p class="leading-5 text-lg mb-4">{{ $question->question }}</p>
                        <div class="relative bg-white rounded-md"></div>
                        @foreach($question->answers->shuffle() as $answer)
                            <label class="relative px-4 py-1 flex flex-col cursor-pointer md:pl-4 md:pr-6">
                                <div class="flex items-center text-sm">
                                    <input
                                        id="{{ $answer->id }}"
                                        type="radio"
                                        name="racer-test-form[{{ $question->id }}]"
                                        value="{{ $answer->index }}"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500"
                                    >
                                    <x-form.label for="{{ $answer->id }}"
                                                  class="ml-3 text-blue-400">{{ $answer->answer }}</x-form.label>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="my-6">
                <x-form.primary-button type="submit">{{ __('Check') }}</x-form.primary-button>
            </div>
        </form>
    </div>
</x-layouts.front>
