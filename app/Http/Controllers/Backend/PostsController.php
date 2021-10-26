<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class PostsController extends Controller
{
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
        (auth()->user())->posts()->create($this->validateForm());

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
        $post->update($this->validateForm());

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
        $post->delete();

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
        ]);
    }

    public function restore(string $post)
    {
        (Post::withTrashed()->findOrFail($post))->restore();

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
        $post->publish($when);

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been published.'),
        ]);
    }

    public function unpublish(Post $post)
    {
        $post->unpublish();

        return redirect()->route('adm.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been unpublished.'),
        ]);
    }

    protected function validateForm()
    {
        return request()->validate([
            'title' => 'required|string|max:240',
            'slug' => 'nullable',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
        ]);
    }
}
