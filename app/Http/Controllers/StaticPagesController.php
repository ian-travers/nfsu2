<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
    public function __invoke(string $page)
    {
        return view('frontend.pages.' . $page, [
            'title' => __('About :what', ['what' => __('pages.' . $page)])
        ]);
    }
}
