<?php

namespace App\Http\Controllers\Backend;

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
        return view('backend.posts.index', [
            'title' => __('Blog posts'),
            'posts' => Post::withTrashed()->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('backend.posts.create', [
            'title' => __('Create new post'),
            'post' => new Post(),
        ]);
    }

    public function store()
    {
        $this->service->create();

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been created.'),
        ]);
    }

    public function edit(Post $post)
    {
        return view('backend.posts.edit', [
            'title' => __('Edit post'),
            'post' => $post,
        ]);
    }

    public function update(Post $post)
    {
        $this->service->edit($post);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been updated.'),
        ]);
    }

    public function show(Post $post)
    {
        return view('backend.posts.show', [
            'title' => __('View post'),
            'post' => $post->load('comments'),
        ]);
    }

    public function remove(Post $post)
    {
        $this->service->trash($post);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
        ]);
    }

    public function restore(string $post)
    {
        $this->service->restore($post);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been restored.'),
        ]);
    }

    public function forceRemove(string $post)
    {
        (Post::withTrashed()->findOrFail($post))->forceDelete();

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been deleted.'),
        ]);
    }

    public function publish(Post $post, Carbon $when = null)
    {
        $this->service->publish($post, $when);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been published.'),
        ]);
    }

    public function unpublish(Post $post)
    {
        $this->service->unpublish($post);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been unpublished.'),
        ]);
    }

    public function removeImage(Post $post)
    {
        $this->service->removeImage($post);

        return redirect()->route('adm.posts.edit', $post)->with('flash', [
            'type' => 'success',
            'message' => __('Post image has been removed.'),
        ]);
    }
}
