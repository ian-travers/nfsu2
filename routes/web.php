<?php

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

    Route::get('register', Register::class)
        ->middleware('guest')
        ->name('register');
    Route::get('/login', Login::class)
        ->middleware(['guest'])
        ->name('login');

    // Dummy route
    Route::get('#', fn() => view('welcome'))->name('#');
});

