<?php

namespace App\Http\Controllers;

use App\Models\Competition\Competition;

class CompetitionsController extends Controller
{
    public function index()
    {
        $competition = Competition::hasActive() ? Competition::active() : null;

        return view('frontend.competitions.index', [
            'title' => __('Competition'),
            'competition' => $competition,
        ]);
    }
}
