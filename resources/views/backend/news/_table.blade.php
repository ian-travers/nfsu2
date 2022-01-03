@php /** @var \App\Models\News $newsitem */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('En') }}</x-table.th>
                        <x-table.th>{{ __('Ru') }}</x-table.th>
                        <x-table.th class="text-center w-10">{{ __('Status') }}</x-table.th>
                        <th scope="col" class="w-12 px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($news as $newsitem)
                        <tr>
                            <td class="px-6 py-1">
                                {{ $newsitem->title_en }}
                                <span class="block text-sm pt-1">{!! Str::words($newsitem->body_en, 20) !!}</span>
                            </td>
                            <td class="px-6 py-1">
                                {{ $newsitem->title_ru }}
                                <span class="block text-sm pt-1">{!! Str::words($newsitem->body_ru, 20) !!}</span>
                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $newsitem->status }}
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                <a
                                    href="{{ route('adm.news.view', $newsitem) }}"
                                    class="text-green-400 hover:text-green-600 block"
                                >
                                    {{ __('View & Comments') }}
                                </a>
                                <a
                                    href="{{ route('adm.news.edit', $newsitem) }}"
                                    class="text-indigo-400 hover:text-indigo-600"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('adm.news.delete', $newsitem) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm(_t('Confirm deleting?'))"
                                        class="text-yellow-500 hover:text-yellow-700"
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
