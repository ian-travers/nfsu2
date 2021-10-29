@php /** @var \App\Models\Post $post */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('Title') }}</x-table.th>
                        <x-table.th>{{ __('Excerpt') }}</x-table.th>
                        <x-table.th class="text-center w-10">{{ __('Published') }}</x-table.th>
                        <x-table.th class="text-center w-10">{{ __('Author') }}</x-table.th>
                        <x-table.th class="text-center w-10">{{ __('Publishing') }}</x-table.th>
                        <th scope="col" class="w-12 px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posts as $post)
                        <tr class="{{ $post->trashed() ? 'bg-gray-100' : '' }}">
                            <td class="px-6 py-1">
                                @if($post->hasImage())
                                    <div class="flex items-center justify-between">
                                        {{ $post->title }}
                                        <img src="{{ $post->imageUrl() }}" alt="Post image" class="w-32">
                                    </div>
                                @else
                                    {{ $post->title }}
                                @endif
                            </td>
                            <td class="px-6 py-1">
                                {{ Str::words($post->excerpt, 8) }}
                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $post->published ? $post->published_at->isoFormat('L') : __('Draft') }}
                            </td>
                            <td>
                                {{ $post->author->username }}
                            </td>
                            <td class="text-center">
                                <form
                                    action="{{ $post->published ? route('adm.posts.unpublish', $post) : route('adm.posts.publish', $post) }}"
                                    method="post"
                                >
                                    @csrf
                                    @method('patch')

                                    <button
                                        type="submit"
                                        onclick="return confirm()"
                                        class="items-center px-4 py-2 rounded-md font-semibold text-sm text-white tracking-widest transition {{ $post->published ? 'bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700' : 'bg-blue-500 hover:bg-blue-700 focus:bg-blue-700' }}"
                                        class=""
                                    >
                                        {{ $post->published ? __('Unpublish') : __('Publish') }}
                                    </button>
                                </form>
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                <a
                                    href="{{ route('adm.posts.view', $post) }}"
                                    class="text-green-400 hover:text-green-600 block"
                                >
                                    {{ __('View & Comments') }}
                                </a>
                                <a
                                    href="{{ route('adm.posts.edit', $post) }}"
                                    class="text-indigo-400 hover:text-indigo-600"
                                >
                                    {{ __('Edit') }}
                                </a>
                                @if($post->trashed())
                                    <form action="{{ route('adm.posts.restore', $post) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button
                                            type="submit"
                                            onclick="return confirm()"
                                            class="text-blue-500 hover:text-blue-700"
                                        >
                                            {{ __('Restore') }}
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('adm.posts.delete', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button
                                            type="submit"
                                            onclick="return confirm()"
                                            class="text-yellow-500 hover:text-yellow-700"
                                        >
                                            {{ __('Trash') }}
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('adm.posts.force-delete', $post) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm()"
                                        class="text-red-500 hover:text-red-700"
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
