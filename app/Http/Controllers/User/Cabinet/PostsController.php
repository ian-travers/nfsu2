<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function store()
    {
        (auth()->user())->posts()->create($this->validateForm());

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been created.'),
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

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been updated.'),
        ]);
    }

    public function trash(Post $post)
    {
        $post->delete();

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
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
