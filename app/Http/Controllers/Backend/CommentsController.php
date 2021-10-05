<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        return view('backend.comments.index', [
            'title' => __('Edit comment'),
            'comments' => Comment::with('author')->paginate(20),
        ]);
    }

    public function edit(Comment $comment)
    {
        session()->put('url.intended', url()->previous() == url()->current() ? route('adm.comments.index') : url()->previous());

        return view('backend.comments.edit', [
            'title' => __('Edit comment'),
            'comment' => $comment,
        ]);
    }

    public function update(Comment $comment)
    {
        $attributes = request()->validate([
            'body' => 'required|min:3|max:1000',
        ]);

        $comment->update($attributes);

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('Comment has been updated.'),
        ]);
    }

    public function remove(Comment $comment)
    {
        $comment->delete();

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Comment has been deleted.'),
        ]);
    }
}
