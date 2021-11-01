<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;

class PostsController extends Controller
{
    protected PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function store()
    {
        $this->service->create();

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been created.'),
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

    public function trash(Post $post)
    {
        $this->service->trash($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
        ]);
    }
}
