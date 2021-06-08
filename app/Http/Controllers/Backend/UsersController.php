<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('backend.users.index', [
            'title' => __('Users'),
            'users' => User::paginate(15),
        ]);
    }

    public function create()
    {
        return view('backend.users.create', [
            'title' => __('Create user'),
            'user' => new User(),
        ]);
    }
}
