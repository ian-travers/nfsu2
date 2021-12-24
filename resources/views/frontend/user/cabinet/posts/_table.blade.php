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
                            <td class="text-center">
                                @unless($post->trashed())
                                    <form
                                        action="{{ $post->published ? route('cabinet.posts.unpublish', $post) : route('cabinet.posts.publish', $post) }}"
                                        method="post"
                                    >
                                        @csrf
                                        @method('patch')

                                        <button
                                            type="submit"
                                            onclick="return confirm(_t('Confirm publish status toggling?'))"
                                            class="items-center px-4 py-2 rounded-md font-semibold text-sm text-white tracking-widest transition {{ $post->published ? 'bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700' : 'bg-blue-500 hover:bg-blue-700 focus:bg-blue-700' }}"
                                            class=""
                                        >
                                            {{ $post->published ? __('Unpublish') : __('Publish') }}
                                        </button>
                                    </form>
                                @endunless
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                @if($post->trashed())
                                    <form action="{{ route('cabinet.posts.restore', $post) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button
                                            type="submit"
                                            onclick="return confirm(_t('Confirm restoring?'))"
                                            class="text-blue-500 hover:text-blue-700"
                                        >
                                            {{ __('Restore') }}
                                        </button>
                                    </form>
                                @else
                                    <a
                                        href="{{ route('cabinet.posts.view', $post) }}"
                                        class="text-green-400 hover:text-green-600 block"
                                    >
                                        {{ __('View') }}
                                    </a>
                                    <a
                                        href="{{ route('cabinet.posts.edit', $post) }}"
                                        class="text-indigo-400 hover:text-indigo-600"
                                    >
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('cabinet.posts.delete', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button
                                            type="submit"
                                            onclick="return confirm(_t('Confirm deleting?'))"
                                            class="text-yellow-500 hover:text-yellow-700"
                                        >
                                            {{ __('Trash') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
