@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('Track #1') }}</x-table.th>
                        <x-table.th>{{ __('Track #2') }}</x-table.th>
                        <x-table.th>{{ __('Track #3') }}</x-table.th>
                        <x-table.th>{{ __('Track #4') }}</x-table.th>
                        <x-table.th>{{ __('Started at') }}</x-table.th>
                        <x-table.th>{{ __('Ended at') }}</x-table.th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($competitions as $competition)
                        <tr>
                            <td class="px-6 py-4">
                                {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track1_id) }}
                            </td>
                            <td class="px-6 py-4 {{ $competition->track2_id ? '' : 'text-gray-400' }}">
                                {{ $competition->track2_id ? \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track2_id) : 'No' }}
                            </td>
                            <td class="px-6 py-4 {{ $competition->track3_id ? '' : 'text-gray-400' }}">
                                {{ $competition->track3_id ? \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track3_id) : 'No' }}
                            </td>
                            <td class="px-6 py-4 {{ $competition->track4_id ? '' : 'text-gray-400' }}">
                                {{ $competition->track4_id ? \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track4_id) : 'No' }}
                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $competition->started_at->format('Y-m-d') }}
                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $competition->ended_at->format('Y-m-d') }}
                            </td>
                            <td class="whitespace-nowrap text-right text-sm font-medium px-6">
                                <a
                                    href="{{ route('adm.competitions.edit', $competition) }}"
                                    class="text-indigo-600 hover:text-indigo-900"
                                >
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('adm.competitions.delete', $competition) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button
                                        type="submit"
                                        onclick="return confirm()"
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

