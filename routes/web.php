<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\NFSUServerController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
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
    Route::get('/login', Login::class)
        ->middleware(['guest'])
        ->name('login');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware(['auth'])
        ->name('logout');

    // Password reset
    Route::group([
        'middleware' => 'guest',
        'as' => 'password'
    ], function () {
        Route::get('/forgot-password', [PasswordResetController::class, 'create'])
            ->name('.request');
        Route::post('/forgot-password', [PasswordResetController::class, 'store'])
            ->name('.email');
        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('.reset');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->name('.update');
    });


    // Dummy route
    Route::get('#', fn() => view('welcome'))->name('#');
});

