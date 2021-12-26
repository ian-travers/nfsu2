<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;

class PostService
{
    public function create(): void
    {
        $attributes = $this->validateForm();

        if (request()->has('image')) {
            /** @var \Illuminate\Http\UploadedFile $uf */
            $uf = request('image');
            $attributes['image'] = $uf->store("blogs/{auth()->user()->username}", 'public');
        } else {
            unset($attributes['image']);
        }

        (auth()->user())->posts()->create($attributes);

    }

    public function edit(Post $post): void
    {
        $attributes = $this->validateForm();

        if (request()->has('image')) {
            /** @var \Illuminate\Http\UploadedFile $uf */
            $uf = request('image');
            $attributes['image'] = $uf->store("blogs/{$post->author->username}", 'public');
            $post->removeImage();
        } else {
            unset($attributes['image']);
        }

        $post->update($attributes);
    }

    public function trash(Post $post): void
    {
        if ($post->published) {
            $post->unpublish();
        }

        $post->delete();
    }

    public function restore(Post $post): void
    {
        $post->restore();
    }

    public function publish(Post $post, Carbon $when = null)
    {
        $post->publish($when);
    }

    public function unpublish(Post $post): void
    {
        $post->unpublish();
    }

    public function removeImage(Post $post): void
    {
        $post->removeImage();
    }

    protected function validateForm(): array
    {
        return request()->validate([
            'title' => 'required|string|max:240|not-regex:/\w{20}/',
            'slug' => 'nullable',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);
    }
}
