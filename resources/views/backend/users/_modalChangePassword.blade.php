<x-modal id="changePassword" title="{{ __('Changing password') }}">
    <p id="user-username" class="font-medium text-xl text-center"></p>
    <form action="{{ route('adm.users.change-password') }}" method="post">
        @csrf
        <input type="hidden" id="user-id" name="id" value="0">
        <div class="mt-4">
            <x-form.label for="password" value="{{ __('Password') }}"/>
            <x-form.input
                class="block mt-1 w-full"
                type="text"
                name="password"
                autofocus required
            />
        </div>
        @error('password')
        <p class="text-red-500 mt-1 text-xs">{{ $message }}</p>
        @else
        <p class="text-gray-500 mt-1 text-xs">{{ __('8-16 characters') }}</p>
        @enderror

        <div class="flex justify-end mt-4 space-x-2">
            <x-form.secondary-button onclick="toggleModal()">
                {{ __('Cancel') }}
            </x-form.secondary-button>
            <x-form.primary-button type="submit">
                {{ __('Persist new password') }}
            </x-form.primary-button>
        </div>
    </form>

</x-modal>

@push('scripts')
<script>
    var openmodal = document.querySelectorAll('.modal-open')
    let selectedModalTargetId = ''
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener('click', function (event) {
            selectedModalTargetId = event.target.attributes.getNamedItem('data-target').value

            let formUsername = document.querySelector('#user-username')
            formUsername.innerHTML = event.target.attributes.getNamedItem('data-user-username').value

            let formUserId = document.querySelector('#user-id')
            formUserId.value = event.target.attributes.getNamedItem('data-user-id').value

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
