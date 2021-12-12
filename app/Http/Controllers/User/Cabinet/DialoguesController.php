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

        return $dialogue
            ? view('frontend.user.cabinet.dialogues.show', [
                'dialogue' => $dialogue,
                'title' => __('Dialog with :partner', ['partner' => $dialogue->partner()->username]),
            ])
            : back()->with('flash', [
                'type' => 'warning',
                'message' => __('You have no dialogue with :username.', ['username' => $username]),
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
            'body' => request('body'),
            'read_at' => now(),
        ]);

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Sent.'),
        ]);
    }

    public function store()
    {
        $dialogue = Dialogue::findWith(request('username'), true);

        $dialogue->addMessage(request('body'));
    }
}
