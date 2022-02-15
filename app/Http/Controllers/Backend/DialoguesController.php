<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Conversation\Dialogue;

class DialoguesController extends Controller
{
    public function index()
    {
        return view('backend.dialogues.index', [
            'title' => __('Dialogues'),
            'dialogues' => Dialogue::paginate(24),
        ]);
    }

    public function show(Dialogue $dialogue)
    {
        return view('backend.dialogues.show', [
            'title' => __('Dialogues'),
            'dialogue' => $dialogue,
        ]);
    }
}
