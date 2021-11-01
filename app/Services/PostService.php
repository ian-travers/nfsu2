<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostService
{
    public function create(): void
    {
        (auth()->user())->posts()->create($this->validateForm());
    }

    public function edit(Post $post): void
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
    }

    public function trash(Post $post): void
    {
        $post->delete();
    }

    public function restore(string $post): void
    {
        (Post::withTrashed()->findOrFail($post))->restore();
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
            'title' => 'required|string|max:240',
            'slug' => 'nullable',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);
    }
}
