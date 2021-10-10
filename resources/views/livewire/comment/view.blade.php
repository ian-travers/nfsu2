<div class="comment-item mb-6">
    <div class="flex items-start space-x-4">
        @livewire('user.avatar', ['user' => $comment->author, 'size' => 6])
        <div class="flex-1">
            <p>
                <span class="font-bold">{{ $comment->author->username }}</span>
                <span>{{ $comment->created_at->diffForHumans() }}</span>
            </p>
            <p class="mt-1">
                {!! $comment->body !!}
            </p>
        </div>
    </div>
    @if(count($children))
        <div class="ml-4 mt-4">
            @foreach($children as $child)
                @livewire('comment.view', ['comment' => $child->comment, 'children' => $child->children])
            @endforeach
        </div>
    @endif
</div>
