<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's post."),
            ]);
        }

        return view('frontend.user.cabinet.posts.edit', [
            'title' => __('Edit post'),
            'post' => $post,
        ]);
    }

    public function update(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to edit someone else's post."),
            ]);
        }

        $this->service->edit($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been updated.'),
        ]);
    }

    public function show(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to view someone else's post here."),
            ]);
        }

        return view('frontend.user.cabinet.posts.show', [
            'title' => __('View post'),
            'post' => $post,
        ]);
    }

    public function trash(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to trash someone else's post."),
            ]);
        }

        $this->service->trash($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been trashed.'),
        ]);
    }

    public function restore(string $post)
    {
        $post = Post::withTrashed()->findOrFail($post);

        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to restore someone else's post."),
            ]);
        }

        $this->service->restore($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been restored.'),
        ]);
    }

    public function publish(Post $post, Carbon $when = null)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to publish someone else's post."),
            ]);
        }

        $this->service->publish($post, $when);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been published.'),
        ]);
    }

    public function unpublish(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __("Impossible to unpublish someone else's post."),
            ]);
        }

        $this->service->unpublish($post);

        return redirect()->route('cabinet.posts.index')->with('flash', [
            'type' => 'success',
            'message' => __('Post has been unpublished.'),
        ]);
    }
}
