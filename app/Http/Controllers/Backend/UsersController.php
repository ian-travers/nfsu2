<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('backend.users.index', [
            'title' => __('Users'),
            'users' => User::withTrashed()->paginate(20),
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function create()
    {
        session()->put('url.intended', url()->previous() == url()->current() ? route('adm.users.index') : url()->previous());

        return view('backend.users.create', [
            'title' => __('Create user'),
            'user' => new User(),
            'countries' => Country::all(),
            'roles' => User::rolesList(),
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users',
            'country' => 'required|string|size:2|regex:/^[A-Z]+$/',
            'email' => 'required|email:filter|unique:users',
            'role' => 'required',
            'password' => 'required|min:8|regex:/^\S*$/u',
        ]);

        $attributes['is_browser_notified'] = request()->has('is_browser_notified');
        $attributes['is_email_notified'] = request()->has('is_email_notified');
        $attributes['password'] = bcrypt($attributes['password']);

        User::create($attributes);

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => 'User has been created.',
        ]);
    }

    public function edit(User $user)
    {
        session()->put('url.intended', url()->previous() == url()->current() ? route('adm.users.index') : url()->previous());

        return view('backend.users.edit', [
            'title' => __('Edit user'),
            'user' => $user,
            'countries' => Country::all(),
            'roles' => User::rolesList(),
        ]);
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|unique:users,username,' . $user->id,
            'country' => 'required|string|size:2|regex:/^[A-Z]+$/',
            'email' => 'required|email:filter|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);

        $attributes['is_browser_notified'] = request()->has('is_browser_notified');
        $attributes['is_email_notified'] = request()->has('is_email_notified');

        $user->update($attributes);

        return redirect()->intended()->with('flash', [
            'type' => 'success',
            'message' => __('User has been updated.'),
        ]);
    }

    public function trash(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('adm.users.index')->with('flash', [
                'type' => 'warning',
                'message' => __('The admin cannot be trashed.'),
            ]);
        }

        if ($user->isTeamCaptain()) {
            return redirect()->route('adm.users.index')->with('flash', [
                'type' => 'warning',
                'message' => __('The team captain cannot be trashed. Handle with the team first.'),
            ]);
        }

        $user->removeAvatarFile();
        $user->delete();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('User has been trashed.'),
        ]);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user->trashed()) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __('User is not trashed.'),
            ]);
        }

        $user->restore();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('User has been restored.'),
        ]);
    }

    public function remove($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user->trashed()) {
            return redirect()->back()->with('flash', [
                'type' => 'error',
                'message' => __('You must trash first.'),
            ]);
        }

        $user->forceDelete();

        return redirect()->back()->with('flash', [
            'type' => 'success',
            'message' => __('User has been removed.'),
        ]);
    }

    public function changePassword()
    {
        $user = User::withTrashed()->findOrFail(request('id'));

        $formData = request()->validate([
            'password' => 'required|min:8|regex:/^\S*$/u',
        ]);

        $user->changePassword($formData['password']);

        return redirect()->route('adm.users.index')->with('flash', [
            'type' => 'success',
            'message' => __('Password has been changed.'),
        ]);
    }
}
