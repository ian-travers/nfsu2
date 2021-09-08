<?php

namespace App\Http\Controllers;

use App\Models\Competition\Competition;

class CompetitionsController extends Controller
{
    public function index()
    {
        return view('frontend.competitions.index', [
            'title' => __('Competition'),
            'competition' => Competition::hasActive() ? Competition::active() : null,
            'competitions' => Competition::passed()->get(),
        ]);
    }

    public function show(Competition $competition)
    {
        return view('frontend.competitions.show', [
            'title' => __('Competition archive'),
            'competition' => $competition,
        ]);
    }

    public function archive()
    {
        return view('frontend.competitions.archive', [
            'title' => __('Competition archive'),
            'competitions' => Competition::passed()->get(),
        ]);
    }
}
