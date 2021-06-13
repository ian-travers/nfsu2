@php /** @var \App\Models\Quiz\Answer $answer */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('In English') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('In Russian') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Answer index') }}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($answers as $answer)
                        <tr>
                            <td class="px-6 py-4">
                                {{ $answer->answer_en }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $answer->answer_ru }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex justify-center">{{ $answer->index }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a
                                    href="{{ route('adm.quiz.answers.edit', [$question, $answer]) }}"
                                    class="text-indigo-600 hover:text-indigo-900 block"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('adm.quiz.answers.delete', [$question, $answer]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm(__('This quiz answer will be deleted! Proceed?'))"
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
