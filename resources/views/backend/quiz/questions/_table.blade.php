@php /** @var \App\Models\Quiz\Question $question */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('In English') }}</x-table.th>
                        <x-table.th>{{ __('In Russian') }}</x-table.th>
                        <x-table.th class="text-center">{{ __('Correct answer index') }}</x-table.th>

                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($questions as $question)
                        <tr>
                            <td class="px-6 py-4">
                                {{ $question->question_en }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $question->question_ru }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex justify-center">{{ $question->correct_answer }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a
                                    href="{{ route('adm.quiz.question.show', $question) }}"
                                    class="text-indigo-600 hover:text-indigo-900 block"
                                >
                                    {{ __('View') }}
                                </a>
                                <a
                                    href="{{ route('adm.quiz.question.edit', $question) }}"
                                    class="text-indigo-600 hover:text-indigo-900 block"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('adm.quiz.question.delete', $question) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm(_t('This quiz question will be deleted! Proceed?'))"
                                        class="text-yellow-600 hover:text-yellow-900"
                                    >
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
