<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\NFSUServerController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\Team\CreateTeamController;
use App\Http\Controllers\User\Team\EditTeamController;
use App\Http\Controllers\User\Team\JoinTeamController;
use App\Http\Controllers\User\Team\ManageTeamController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'language'], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::group([
        'prefix' => 'server',
        'as' => 'server.',
    ], function () {
        Route::get('monitor', [NFSUServerController::class, 'monitor'])->name('monitor');
        Route::get('best-performers', [NFSUServerController::class, 'bestPerformersRedirect'])->name('best-performers-redirect');
        Route::get('best-performers/{type}/{track}', [NFSUServerController::class, 'bestPerformers'])->name('best-performers');
        Route::get('ratings', [NFSUServerController::class, 'ratingsRedirect'])->name('ratings-redirect');
        Route::get('ratings/{type}', [NFSUServerController::class, 'ratings'])->name('ratings');
    });

    // Auth
    Route::get('register', Register::class)
        ->middleware('guest')
        ->name('register');
    Route::get('login', Login::class)
        ->middleware(['guest'])
        ->name('login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('logout');

    // Password reset
    Route::group([
        'middleware' => 'guest',
        'as' => 'password'
    ], function () {
        Route::get('forgot-password', [PasswordResetController::class, 'create'])
            ->name('.request');
        Route::post('forgot-password', [PasswordResetController::class, 'store'])
            ->name('.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('.update');
    });

    // User settings
    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'settings',
        'as' => 'settings'
    ], function () {
        Route::get('profile', Profile::class)->name('.profile');
        Route::get('account', [AccountController::class, 'show'])->name('.account');

        Route::group([
            'prefix' => '/team',
            'as' => '.team'
        ], function () {
            Route::get('', [ManageTeamController::class, 'index'])->name('.index');
            Route::get('create', [CreateTeamController::class, 'create'])->name('.create');
            Route::post('', [CreateTeamController::class, 'store'])->name('.store');
            Route::get('edit', [EditTeamController::class, 'edit'])->name('.edit');
            Route::patch('', [EditTeamController::class, 'update'])->name('.update');
            Route::delete('', [ManageTeamController::class, 'dismiss'])->name('.dismiss');

            Route::group([
                'prefix' => 'join',
                'as' => '.join',
            ], function () {
                Route::get('', [JoinTeamController::class, 'join'])->name('.join');
                Route::post('', [JoinTeamController::class, 'store'])->name('.store');
                Route::delete('', [JoinTeamController::class, 'leave'])->name('.leave');
            });

            Route::group([
                'prefix' => 'members',
                'as' => '.members',
            ], function () {
                Route::post('remove/{user}', [ManageTeamController::class, 'removeMember'])->name('.remove');
                Route::post('transfer/{user}', [ManageTeamController::class, 'transferCaptainship'])->name('.transfer');
            });
        });
    });


    // Dummy route
    Route::get('#', fn() => view('welcome'))->name('#');
});

