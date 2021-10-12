<div class="comment-item mb-6" data-id="{{ $comment->id }}">
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
            <div class="mt-2">
                <button
                    id="show-reply-form"
                    class="text-gray-300 hover:text-gray-200 hover:underline transition"
                >
                    {{ __('Reply') }}
                </button>
                <div id="reply-block-{{$comment->id}}" class=""></div>
            </div>
        </div>
    </div>



{{--    @if(count($children))--}}
        <span class="text-yellow-500">{{ count($children) }}</span>
        <div class="ml-4 mt-4">
            @foreach($children as $child)
                @livewire('comment.view', ['comment' => $child->comment, 'children' => $child->children], key($child->comment->id))
            @endforeach
        </div>
{{--    @endif--}}
</div>
