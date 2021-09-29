<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class DownloadsController extends Controller
{
    public function __invoke(string $filename)
    {
        $class = "\\App\\Models\Downloads\\" . Str::studly($filename);
        $file = new $class;

        return view('frontend.downloads.' . $filename, [
            'title' => $file->title(),
            'file' => $file,
        ]);
    }
}
