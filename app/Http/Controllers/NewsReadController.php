<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsReadController extends Controller
{
    public function index()
    {
        return view('frontend.news.index', [
            'title' => __('News'),
            'news' => News::latest()->paginate(4),
        ]);
    }

    public function show(News $newsitem)
    {
        return view('frontend.news.show', [
            'title' => $newsitem->title,
            'newsitem' => $newsitem,
        ]);
    }
}
