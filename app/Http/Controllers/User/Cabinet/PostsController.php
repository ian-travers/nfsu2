<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Carbon\Carbon;

class PostsController extends Controller
{
    protected PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function index()
    {
        return view('frontend.user.cabinet.posts.index', [
            'title' => __('Your posts'),
            'posts' => auth()->user()->posts()->withTrashed()->latest('published_at')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('frontend.user.cabinet.posts.create', [
            'title' => __('Create new post'),
            'post' => new Post(),
        ]);
    }

    public function store()
    {
        $this->service->create();

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been created.'),
        ]);
    }

    public function edit(Post $post)
    {
        return view('frontend.user.cabinet.posts.edit', [
            'title' => __('Edit post'),
            'post' => $post,
        ]);
    }

    public function update(Post $post)
    {
        $this->service->edit($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been updated.'),
        ]);
    }

    public function show(Post $post)
    {
        return view('frontend.user.cabinet.posts.show', [
            'title' => __('View post'),
            'post' => $post,
        ]);
    }

    public function trash(Post $post)
    {
        $this->service->trash($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
        ]);
    }

    public function restore(string $post)
    {
        $this->service->restore($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been restored.'),
        ]);
    }

    public function publish(Post $post, Carbon $when)
    {
        $this->service->publish($post, $when);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been published.'),
        ]);
    }

    public function unpublish(Post $post)
    {
        $this->service->unpublish($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been unpublished.'),
        ]);
    }
}
