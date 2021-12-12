<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Conversation\Dialogue;

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

    public function store()
    {
        $dialogue = Dialogue::findWith(request('username'), true);

        $dialogue->addMessage(request('body'));
    }
}
