<x-layouts.front title="{{ $title }}">
    <div class="mt-3 md:mt-4 mx-auto px-4 md:px-8 text-blue-400 max-w-screen-2xl">
        <h2 class="text-xl md:text-3xl my-4 md:my-8 text-center tracking-wider font-medium">{{ __('Rules of the NFSU Cup') }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 lg:gap-8">
            <div class="lg:col-span-2 lg:border-r lg:border-blue-400 lg:pr-4">
                <h3 class="text-2xl text-center py-2">{{ __('Rules') }}</h3>
                <h4 class="text-lg pt-6 pb-3">{{ __('rules.h4-01') }}</h4>
                <p class="pb-2">{!! __('rules.p-01-01') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-02') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-03') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-04') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-05') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-06') !!}</p>
                <p class="pb-2">{!! __('rules.p-01-07') !!}</p>
                <h4 class="text-lg pt-6 pb-3">{{ __('rules.h4-02') }}</h4>
                <p class="pb-2">{!! __('rules.p-02-01') !!}</p>
                <p class="pb-2">{!! __('rules.p-02-02') !!}</p>
                <h4 class="text-lg pt-6 pb-3">{{ __('rules.h4-03') }}</h4>
                <p class="pb-2">{!! __('rules.p-03-01') !!}</p>
                <p class="pb-2">{!! __('rules.p-03-02') !!}</p>
                <p class="pb-2">{!! __('rules.p-03-03') !!}</p>
                <p class="pb-2">{!! __('rules.p-03-04') !!}</p>
                <p class="pb-2">{!! __('rules.p-03-05') !!}</p>
                <h4 class="text-lg pt-6 pb-3">{{ __('rules.h4-04') }}</h4>
                <p class="pb-2">{!! __('rules.p-04-01') !!}</p>
                <p class="pb-2">{!! __('rules.p-04-02') !!}</p>
                <h4 class="text-lg pt-6 pb-3">{{ __('rules.h4-05') }}</h4>
                <p class="pb-2">{!! __('rules.p-05-01') !!} </p>
                <p class="pb-2">{!! __('rules.p-05-02') !!} </p>
            </div>
            <div>
                <h3 class="text-2xl text-center pt-2 pb-6">{{ __('Quiz') }}</h3>
                @error('quiz-form')<p class="text-red-500 text-sm p-2">{{ __('The quiz form is not completed') }}</p>@enderror
                <form action="{{ route('rules-check') }}" method="post">
                    @csrf
                    @foreach($questions as $question)
                        <div class="p-2">
                            <p class="text-base">{{ $question->question }}</p>
                            @foreach($question->answers->shuffle() as $answer)
                                <div class="form-check">
                                    <input
                                        id="{{ $answer->id }}"
                                        class="form-check-input pl-3"
                                        type="radio"
                                        name="quiz-form[{{ $question->id }}]"
                                        value="{{$answer->index}}"
                                    >
                                    <label class="text-sm" for="{{ $answer->id }}">
                                        {{ $answer->answer }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="mt-3">
                        <x-form.primary-button type="submit">{{ __('Check') }}</x-form.primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.front>
