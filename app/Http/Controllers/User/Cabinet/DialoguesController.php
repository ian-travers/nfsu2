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

    public function show(Dialogue $dialogue)
    {
        return view('frontend.user.cabinet.dialogues.show', [
            'dialogue' => $dialogue,
            'title' => __('Dialog with :partner', ['partner' => $dialogue->partner()->username]),
        ]);
    }

    public function store()
    {
        $dialogue = Dialogue::getOrCreateWith(request('username'));

        $dialogue->addMessage(request('body'));
    }
}
