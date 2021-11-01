<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $attributes = $this->validateForm();
        $attributes['slug'] = Str::slug($attributes['title']) . '-' . Str::padLeft($post->id, 8, '0');

        if (request()->has('image')) {
            /** @var \Illuminate\Http\UploadedFile $uf */
            $uf = request('image');
            $attributes['image'] = $uf->store("blogs/{$post->author->username}", 'public');
            $post->removeImage();
        } else {
            unset($attributes['image']);
        }

        $post->update($attributes);

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

    public function removeImage(Post $post)
    {
        $post->removeImage();

        return redirect()->route('adm.posts.edit', $post)->with('flash', [
            'type' => 'success',
            'message' => __('Post image has been removed.'),
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
            'published_at' => 'nullable|date',
        ]);
    }
}
