<div id="comments">
    <div class="text-lg mb-6">
        @if(app()->getLocale() == 'en')
            {{ $count }}
            {{ __(Str::plural('comments',  )) }}
        @else
            Комментариев: {{ $count }}
        @endif
    </div>
    <div class="mb-6">
        @auth
            @livewire('comment.form', ['user' => auth()->user(), 'commentable' => $commentable])
            @livewire('comment.reply', ['user' => auth()->user(), 'commentable' => $commentable])
        @else
            <x-link href="{{ route('login') }}">Login</x-link>
            to discuss this news
        @endauth
    </div>
    @foreach($comments as $commentView)
        @livewire('comment.view', ['comment' => $commentView->comment, 'children' => $commentView->children],
        key($commentView->comment->id))
    @endforeach
</div>
