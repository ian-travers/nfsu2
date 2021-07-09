@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-3">
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('cabinet.tourneys.edit', $tourney) }}">
                    <x-form.primary-button>{{ __('Edit') }}</x-form.primary-button>
                </a>

                <form action="{{ route('cabinet.tourneys.delete', $tourney) }}" method="post">
                    @csrf
                    @method('delete')
                    <x-form.danger-button
                        type="submit"
                        onclick="return confirm()"
                    >
                        {{ __('Delete') }}
                    </x-form.danger-button>
                </form>

                <a href="{{ route('cabinet.tourneys.index') }}">
                    <x-form.primary-button>{{ __('My tourneys') }}</x-form.primary-button>
                </a>
            </div>

            <div class="flex items-start justify-between mt-4">
                <div class="flex">
                    <div class="w-32">
                        <p>{{ __('Type') }}</p>
                        <p>{{ __('Track') }}</p>
                        <p>{{ __('Date') }}</p>
                        <p>{{ __('Status') }}</p>
                    </div>
                    <div>
                        <p>{{ __(Str::ucfirst($tourney->type())) }}</p>
                        <p>{{ $tourney->trackName() }}</p>
                        <p>{{ $tourney->started_at->format('H:i d M Y') }}</p>
                        <p>{{ __(Str::ucfirst($tourney->status)) }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-3xl">{{ $tourney->name }}</p>
                </div>
            </div>

            {{-- Operations--}}
            <div class="border-t border-b border-blue-200 flex flex-col space-y-3 lg:flex-row lg:space-y-0 lg:items-center lg:space-x-2 py-3 mt-4">
                <p class="inline">{{ __('Handling') }}:</p>
                <form action="{{ route('cabinet.tourneys.handle.draw', $tourney) }}" method="post" class="inline">
                    @csrf
                    @method('put')
                    <x-form.primary-button type="submit">{{ __('Random draw') }}</x-form.primary-button>
                </form>

                <form action="{{ route('cabinet.tourneys.handle.start', $tourney) }}" method="post" class="inline">
                    @csrf
                    @method('patch')
                    <x-form.primary-button type="submit">{{ __('Approve the draw and start the tourney') }}</x-form.primary-button>
                </form>

                <form action="{{ route('cabinet.tourneys.handle.final', $tourney) }}" method="post" class="inline">
                    @csrf
                    @method('patch')
                    <x-form.primary-button type="submit">{{ __('Announce the final round') }}</x-form.primary-button>
                </form>

                <form action="#" class="inline">
                    <x-form.primary-button>{{ __('Complete the tourney') }}</x-form.primary-button>
                </form>
            </div>

            <div class="mt-3 md:mt-6">
                <div
                    class="flex flex-col items-center space-y-3 md:flex-row md:items-start md:justify-around md:space-y-0 md:space-x-4">
                    <div class="hidden lg:block md:w-1/6">
                        <p class="text-lg font-medium mb-1">{{ __('Signed up') }}</p>
                        <x-tourneys.signedup-table :tourney="$tourney"/>
                    </div>
                    <div class="md:w-2/5">
                        <p class="text-lg font-medium mb-1">{{ __('Standings') }}</p>
                        <x-tourneys.standings-table :tourney="$tourney"/>
                    </div>
                </div>
            </div>
            @unless($tourney->isScheduled())
                @if($tourney->heats()->count())
                    <div class="mt-6 border-t border-black">
                        @for($round = 1; $round <= 5; $round++)
                            <div class="border rounded-md p-4 my-8">
                                <x-tourneys.round :round="$round" :heats="$tourney->heats()->where('round', $round)->orderBy('heat_no')->get()"/>
                            </div>
                        @endfor
                    </div>

                @endif
            @endunless
        </div>

        <x-modal id="updateHeatResults" title="{{ __('Heat results') }}">
            @livewire('heat.results-form')
        </x-modal>

    </div>

    @push('scripts')
        <script>
            var openmodal = document.querySelectorAll('.modal-open')
            let selectedModalTargetId = ''
            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function (event) {
                    selectedModalTargetId = event.target.attributes.getNamedItem('data-target').value
                    heatId = event.target.attributes.getNamedItem('data-heat-id').value
                    Livewire.emit('heatProvided', heatId)
                    event.preventDefault()
                    toggleModal()
                })
            }

            var overlay = document.querySelectorAll('.modal-overlay')
            for (var i = 0; i < overlay.length; i++) {
                overlay[i].addEventListener('click', toggleModal)
            }


            var closemodal = document.querySelectorAll('.modal-close')
            for (var i = 0; i < closemodal.length; i++) {
                closemodal[i].addEventListener('click', toggleModal)
            }

            document.onkeydown = function (evt) {
                evt = evt || window.event
                var isEscape
                if ("key" in evt) {
                    isEscape = (evt.key === "Escape" || evt.key === "Esc")
                } else {
                    isEscape = (evt.keyCode === 27)
                }
                if (isEscape && document.body.classList.contains('modal-active')) {
                    toggleModal()
                }
            }

            function toggleModal() {
                if (!selectedModalTargetId) {
                    return
                }
                const body = document.querySelector('body')
                const modal = document.getElementById(selectedModalTargetId)
                modal.classList.toggle('opacity-0')
                modal.classList.toggle('pointer-events-none')
                body.classList.toggle('modal-active')
            }

            window.addEventListener('modalSubmitted', () => {
                toggleModal()
            })
        </script>
    @endpush
</x-layouts.cabinet>
