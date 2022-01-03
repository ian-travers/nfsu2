<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('backend.news.index', [
            'title' => __('News'),
            'news' => News::latest()->paginate(25),
        ]);
    }

    public function create()
    {
        return view('backend.news.create', [
            'title' => __('Create news item'),
            'newsitem' => new News(),
        ]);
    }

    public function store()
    {
        News::create($this->validateForm());

        return redirect()->route('adm.news.index')->with('flash', [
            'type' => 'success',
            'message' => __('News has been created.'),
        ]);
    }

    public function edit(News $newsitem)
    {
        return view('backend.news.edit', [
            'title' => __('Edit news item'),
            'newsitem' => $newsitem,
        ]);
    }

    public function update(News $newsitem)
    {
        $newsitem->update($this->validateForm());

        return redirect()->route('adm.news.index')->with('flash', [
            'type' => 'success',
            'message' => __('News has been updated.'),
        ]);
    }

    public function show(News $newsitem)
    {
        return view('backend.news.show', [
            'title' => __('View news item'),
            'newsitem' => $newsitem->load('comments'),
        ]);
    }

    public function remove(News $newsitem)
    {
        $newsitem->delete();

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('News has been deleted.'),
        ]);
    }

    protected function validateForm()
    {
        return request()->validate([
            'title_en' => 'required|string|min:3|max:240',
            'title_ru' => 'required|string|min:3|max:240',
            'slug' => 'nullable',
            'body_en' => 'required|string',
            'body_ru' => 'required|string',
            'status' => 'required',
            'created_at' => 'required|date',
        ]);
    }
}
