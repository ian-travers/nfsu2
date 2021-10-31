<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class PostsReadController extends Controller
{
    public function index()
    {
        return view('frontend.posts.index', [
            'title' => __('Blog'),
            'posts' => Post::published()->latest('published_at')->paginate(3),
        ]);
    }

    public function show(Post $post)
    {
        visits($post)->increment();

        return view('frontend.posts.show', [
            'title' => $post->title,
            'post' => $post->load(['comments.author'])->loadCount('comments'),
            'commentViews' => Comment::treeRecursive($post->comments, null),
        ]);
    }
}
