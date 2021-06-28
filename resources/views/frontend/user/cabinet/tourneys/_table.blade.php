@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Name') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Track') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Starts at') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Signup time') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Room') }}
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('Status') }}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tourneys as $tourney)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $tourney->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($tourney->track_id) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $tourney->started_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $tourney->signup_time }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $tourney->room }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-tourney-status-badge :tourney="$tourney"/>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" rowspan="2">
                                <a
                                    href="{{ route('cabinet.tourneys.edit', $tourney) }}"
                                    class="text-indigo-600 hover:text-indigo-700"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('cabinet.tourneys.delete', $tourney) }}" method="post">
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
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" colspan="5">
                                <span class="text-gray-500">{{ __('Additional information') }}</span>
                                {{ $tourney->description ?? __('No additional information')  }}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

