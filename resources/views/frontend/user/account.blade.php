<x-layouts.settings username="{{ $user->username }}" title="{{ $title }}">
    <div class="overflow-hidden rounded sm:rounded-md text-gray-900">
        <div class="px-4 py-5 bg-white space-y-4">
            <div class="border border-blue-100 rounded sm:rounded-md">
                <div class="bg-blue-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Password') }}</h3>
                </div>
                <div class="px-4 py-2">
                    <p class="my-3">{{ __('Click the button below for changing password.') }}</p>
                    <x-form.primary-button
                        type="button"
                        data-target="changePassword"
                        class="modal-open">
                        {{ __('Change password') }}...
                    </x-form.primary-button>
                </div>
            </div>

            <div class="border border-red-100 rounded sm:rounded-md">
                <div class="bg-red-100 px-4 py-2">
                    <h3 class="text-2xl sm:text-3xl">{{ __('Delete account') }}</h3>
                </div>
                <div class="px-4 py-2">
                    <p class="my-3">{{ __('Once you delete your account, there is no going back. Please be certain.') }}</p>
                    <x-form.danger-button
                        type="button"
                        data-target="deleteAccount"
                        class="modal-open">
                        {{ __('Delete your account') }}...
                    </x-form.danger-button>
                </div>
            </div>
        </div>

        <!--Modal change password -->
        <x-modal id="changePassword" title="{{ __('Changing password') }}">
            {{--        @livewire('user.change-password-form')--}}
        </x-modal>
        <!--Modal delete account -->
        <x-modal id="deleteAccount" title="{{ __('Deleting account') }}">
            @livewire('user.delete-account')
        </x-modal>
    </div>

    @push('scripts')
        <script>
            var openmodal = document.querySelectorAll('.modal-open')
            let selectedModalTargetId = ''
            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function (event) {
                    selectedModalTargetId = event.target.attributes.getNamedItem('data-target').value
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

</x-layouts.settings>

