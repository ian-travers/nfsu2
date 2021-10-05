@php /** @var \App\Models\Comment $comment */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-200">
                    <tr>
                        <x-table.th class="w-60">{{ __('Author & Date') }}</x-table.th>
                        <x-table.th>{{ __('Comment') }}</x-table.th>
                        <th scope="col" class="w-12 px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($newsitem->comments as $comment)
                        <tr>
                            <td class="px-6 py-4">
                                @livewire('user.avatar', ['user' => $comment->author, 'size' => 6])
                                {{ $comment->author->username }}
                                <span class="text-gray-400 text-xs block">{{ $comment->updated_at->format('Y-m-d H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $comment->body }}
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                <a
                                    href="{{ route('adm.comments.edit', $comment) }}"
                                    class="text-indigo-400 hover:text-indigo-600"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('adm.comments.delete', $comment) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm()"
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
