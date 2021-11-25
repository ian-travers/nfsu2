@php /** @var \App\Models\Post $post */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-300 border border-blue-400">
                    <thead>
                    <tr>
                        <x-table.th>{{ __('Notification content') }}</x-table.th>
                        <x-table.th class="hidden sm:table-cell text-center w-40">{{ __('Read at') }}</x-table.th>
                        <x-table.th class="text-center w-16">{{ __('Actions') }}</x-table.th>

                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-400">
                    @foreach($notifications as $notification)
                        <tr>
                            <td class="px-6 py-1">
                                @if($notification->type == 'App\Notifications\PostWasPublished')
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($notification->data['at'])->isoFormat('ll') }}</span>
                                    <span>{{ $notification->data['author'] }}</span>
                                    <span class="text-sm">{{ __('published') }}</span>
                                    <x-link
                                        href="{{ $notification->data['link'] }}"
                                    >
                                        {{ $notification->data['title'] }}
                                    </x-link>
                                @elseif($notification->type == 'App\Notifications\TourneyWasCreated')

                                @elseif($notification->type == 'App\Notifications\CompetitionWasCreated')
                                    <span>{{ __('It looks like a competition has begun or is about to start.') }}</span>
                                    <span>
                                        {{ __('It ends at:') }}
                                        {{ $notification->data['ends_at'] }}
                                    </span>
                                    <x-link
                                        href="{{ $notification->data['link'] }}"
                                    >
                                        {{ __('View details') }}
                                    </x-link>
                                @else
                                    <span class="text-sm">Unknown notification</span>
                                @endif

                            </td>
                            <td class="hidden sm:table-cell text-center px-6 py-4">
                                {{ $notification->read() ? $notification->read_at->isoFormat('ll') : '' }}
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                <form action="{{ route('notifications.toggleRead', $notification->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button
                                        type="submit"
                                        onclick="return confirm()"
                                        class="text-indigo-600 hover:text-indigo-700"
                                    >
                                        {{ $notification->read() ? __('Mark unread') : __('Mark read') }}
                                    </button>
                                </form>
                                <form action="{{ route('notifications.delete', $notification->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm()"
                                        class="text-red-600 hover:text-red-700"
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
