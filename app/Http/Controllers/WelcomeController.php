<?php

namespace App\Http\Controllers;

use App\Models\News;

class WelcomeController extends Controller
{
    public function index()
    {
        $lastNews = News::published()->latest()->take(3)->get();

        $actions = auth()->guest() ? [] : auth()->user()->actions()->latest()->where('created_at', '>', now()->subWeeks(4))->get();

//        return $actions;

        return view('welcome', [
            'news' => $lastNews,
            'actions' => $actions
        ]);
    }
}
