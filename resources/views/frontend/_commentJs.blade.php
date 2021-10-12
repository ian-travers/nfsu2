@push('scripts')
    <script type="text/javascript">
        var allComments = document.querySelectorAll('#show-reply-form')
        let selectedCommentId = ''
        let form = document.querySelector('#reply-form')

        for (var i = 0; i < allComments.length; i++) {
            allComments[i].addEventListener('click', function () {
                let comment = this.closest('.comment-item')
                selectedCommentId = comment.attributes.getNamedItem('data-id').value

                let formDiv = document.querySelector('#reply-block-' + selectedCommentId)
                let replyDiv = document.querySelector('#reply-form')

                formDiv.appendChild(replyDiv)

                Livewire.emit('setParentComment', selectedCommentId)
            })
        }
    </script>
@endpush

