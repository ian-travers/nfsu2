<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        return view('backend.users.index', ['title' => __('Users')]);
    }
}
