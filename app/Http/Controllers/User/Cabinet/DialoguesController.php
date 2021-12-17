<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Conversation\Dialogue;
use App\Models\Conversation\Message;

class DialoguesController extends Controller
{
    public function index()
    {
        return view('frontend.user.cabinet.dialogues.index', [
            'dialogues' => Dialogue::allByUser()->paginate(24),
            'title' => __('Your dialogues'),
        ]);
    }

    public function show(string $username)
    {
        $dialogue = Dialogue::findWith($username);

        if (is_null($dialogue)) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => __('You have no dialogue with :username.', ['username' => $username]),
            ]);
        }

        if ($dialogue->hasUnread()) {
            $dialogue->markAsRead();
        }

        return view('frontend.user.cabinet.dialogues.show', [
            'dialogue' => $dialogue,
            'title' => __('Dialog with :partner', ['partner' => $dialogue->partner()->username]),
        ]);
    }

    public function addMessage(string $username)
    {
        request()->validate([
            'body' => 'required|max:240',
        ]);

        $dialogue = Dialogue::findWith($username);

        Message::create([
            'dialogue_id' => $dialogue->id,
            'user_id' => auth()->id(),
            'receiver_id' => $dialogue->partner()->id,
            'body' => request('body'),
        ]);

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Sent.'),
        ]);
    }

    public function store()
    {
        $dialogue = Dialogue::findWith(request('username'), true);

        return view('frontend.user.cabinet.dialogues.show', [
            'dialogue' => $dialogue,
            'title' => __('Dialog with :partner', ['partner' => $dialogue->partner()->username]),
        ]);
    }

    public function block(string $username)
    {
        $dialogue = Dialogue::findWith($username);

        $dialogue->block();

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Your dialogue with :username has been blocked.', ['username' => $username]),
        ]);
    }
}
