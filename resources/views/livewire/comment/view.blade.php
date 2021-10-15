<div class="comment-item mt-3 mb-6" data-id="{{ $comment->id }}">
    <div class="flex items-start space-x-4">
        @livewire('user.avatar', ['user' => $comment->author, 'size' => 6])
        <div class="flex-1">
            <p>
                @if($comment->author->trashed())
                    <span class="font-bold text-gray-400 line-through">{{ $comment->author->username }}</span>
                @else
                    <span class="font-bold">
                        <x-link href="{{ route('public-profile', $comment->author->username) }}">{{ $comment->author->username }}</x-link>
                    </span>
                @endif
                <span>{{ $comment->created_at->diffForHumans() }}</span>
            </p>
            <p class="mt-1">
                {!! $comment->body !!}
            </p>
            <div class="flex items-center space-x-10 mt-2">
                @livewire('like-dislike', ['model' => $comment])
                @auth
                    <div>
                        @if($authorized)
                            @livewire('comment.delete', ['comment' => $comment])
                        @else
                            <button
                                id="show-reply-form"
                                class="text-gray-300 hover:text-gray-200 hover:underline transition text-sm uppercase tracking-widest"
                            >
                                {{ __('Reply') }}
                            </button>

                        @endif
                    </div>

                @endauth
            </div>
            <div id="reply-block-{{$comment->id}}" class="mt-2"></div>
        </div>
    </div>

    @foreach($children as $child)
        @livewire('comment.view', ['comment' => $child->comment, 'children' => $child->children],
        key($child->comment->id))
    @endforeach
</div>
