@php /** @var \App\Models\Tourney\Tourney $tourney */ @endphp

<x-layouts.cabinet title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="bg-white px-4 py-3">
            @include('frontend.user.cabinet.handle-tourney._header')

            {{-- Operations--}}
            <div class="border-t border-b border-blue-200 flex flex-col space-y-3 lg:flex-row lg:space-y-0 lg:items-center lg:space-x-2 py-3 mt-4">
                <p class="inline">{{ __('Handling') }}:</p>
                @livewire('tourney-handle.draw', ['tourney' => $tourney])
                @livewire('tourney-handle.start', ['tourney' => $tourney])
                @livewire('tourney-handle.announce-final', ['tourney' => $tourney])
                @livewire('tourney-handle.complete', ['tourney' => $tourney])
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

        <x-modal id="addFinalRacer" title="{{ __('Add racer to the final round') }}">
            @livewire('heat.add-racer-form')
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
