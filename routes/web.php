<?php

use App\Http\Controllers\NFSUServerController;
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
        Route::get('best-performers', [NFSUServerController::class, 'bestPerformersRedirect'])->name('bestPerformersRedirect');
        Route::get('best-performers/{type}/{track}', [NFSUServerController::class, 'bestPerformers'])->name('best-performers');
    });
});

