@php /** @var \App\Models\Competition\Competition $competition */ @endphp

<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <x-table.th>{{ __('Competition tracks') }}</x-table.th>
                        <x-table.th class="text-center">{{ __('Started at') }}</x-table.th>
                        <x-table.th class="text-center">{{ __('Ended at') }}</x-table.th>
                        <x-table.th class="text-center w-10">{{ __('Active') }}</x-table.th>
                        <th scope="col" class="w-12 px-6 py-3">
                            <span class="sr-only">Manage</span>
                        </th>
                        <th scope="col" class="w-12 px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($competitions as $competition)
                        <tr>
                            <td class="px-6 py-1">
                                <p class="text-sm">
                                    {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track1_id) }}
                                </p>
                                @if($competition->track2_id)
                                    <p class="text-sm">
                                        {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track2_id) }}
                                    </p>
                                @endif
                                @if($competition->track3_id)
                                    <p class="text-sm">
                                        {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track3_id) }}
                                    </p>
                                @endif
                                @if($competition->track4_id)
                                    <p class="text-sm">
                                        {{ \App\Models\NFSUServer\SpecificGameData::getTrackName($competition->track4_id) }}
                                    </p>
                                @endif

                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $competition->started_at->format('Y-m-d') }}
                            </td>
                            <td class="text-center px-6 py-4">
                                {{ $competition->ended_at->format('Y-m-d') }}
                            </td>
                            <td class="text-center">
                                @unless($competition->isCompleted())
                                    @if($competition->isStarted())
                                        <svg class="mx-auto h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                @endunless
                            </td>
                            <td>
                                @if($competition->isCompletable())
                                    @livewire('competition.complete', ['competition' => $competition])
                                @endif
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

