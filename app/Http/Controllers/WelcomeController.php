<?php

namespace App\Http\Controllers;

use App\Models\News;

class WelcomeController extends Controller
{
    public function index()
    {
        $lastNews = News::published()->latest()->take(3)->get();

        return view('welcome', [
            'news' => $lastNews,
        ]);
    }
}
