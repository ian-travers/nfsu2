<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Quiz\AnswersController;
use App\Http\Controllers\Backend\Quiz\QuestionsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\NFSUServerController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\Tests\RacerController;
use App\Http\Controllers\TourneysController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\Cabinet\CabinetController;
use App\Http\Controllers\User\Cabinet\HandleTourneyController as CabinetHandleTourneyController;
use App\Http\Controllers\User\Cabinet\TourneysController as CabinetTourneysController;
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
        'prefix' => 'tourneys',
        'as' => 'tourneys',
    ], function () {
        Route::get('', [TourneysController::class, 'index'])->name('.index');
        Route::get('{tourney}', [TourneysController::class, 'show'])->name('.show');
        Route::post('{tourney}/signup', [TourneysController::class, 'signup'])->middleware('auth')->name('.signup');
        Route::post('{tourney}/withdraw', [TourneysController::class, 'withdraw'])->middleware('auth')->name('.withdraw');
    });

    Route::group([
        'middleware' => 'auth',
        'prefix' => 'tests',
        'as' => 'tests',
    ], function () {
        Route::get('racer', [RacerController::class, 'show'])->name('.racer.show');
        Route::post('racer', [RacerController::class, 'check'])->name('.racer.check');
    });

    Route::get('players/{user:username}', [PublicProfileController::class, 'show'])->name('public-profile');

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

    // User Cabinet
    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'cabinet',
        'namespace' => 'User\Cabinet',
        'as' => 'cabinet'
    ], function () {
        Route::get('', [CabinetController::class, 'index'])->name('.index');
        Route::group([
            'middleware' => ['racer'],
            'prefix' => 'tourneys',
            'as' => '.tourneys'
        ], function () {
            Route::get('', [CabinetTourneysController::class, 'index'])->name('.index');
            Route::get('create', [CabinetTourneysController::class, 'create'])->name('.create');
            Route::post('', [CabinetTourneysController::class, 'store'])->name('.store');
            Route::get('edit/{tourney}', [CabinetTourneysController::class, 'edit'])->name('.edit');
            Route::patch('{tourney}', [CabinetTourneysController::class, 'update'])->name('.update');
            Route::delete('{tourney}', [CabinetTourneysController::class, 'remove'])->name('.delete');

            // Handle the tourney
            Route::group([
                'prefix' => 'handle',
                'as' => '.handle',
            ], function () {
                Route::get('{tourney}', [CabinetHandleTourneyController::class, 'index'])->name('.index');
                Route::put('{tourney}/draw', [CabinetHandleTourneyController::class, 'draw'])->name('.draw');
                Route::patch('{tourney}/start', [CabinetHandleTourneyController::class, 'start'])->name('.start');
            });

        });
    });

    // Backend
    Route::group([
        'middleware' => ['auth', 'admin'],
        'prefix' => 'adm',
        'namespace' => 'Backend',
        'as' => 'adm'
    ], function () {
        Route::get('', [DashboardController::class, 'show'])->name('.dashboard');

        // Users
        Route::group([
            'prefix' => 'users',
            'as' => '.users',
        ], function () {
            Route::get('', [UsersController::class, 'index'])->name('.index');
            Route::get('create', [UsersController::class, 'create'])->name('.create');
            Route::post('', [UsersController::class, 'store'])->name('.store');
            Route::get('edit/{user}', [UsersController::class, 'edit'])->name('.edit');
            Route::patch('{user}', [UsersController::class, 'update'])->name('.update');
            Route::put('trash/{user}', [UsersController::class, 'trash'])->name('.trash');
            Route::put('restore/{id}', [UsersController::class, 'restore'])->name('.restore');
            Route::put('delete/{id}', [UsersController::class, 'remove'])->name('.delete');
            Route::post('change-password', [UsersController::class, 'changePassword'])->name('.change-password');
        });

        // Quiz
        Route::group([
            'prefix' => 'quiz',
            'as' => '.quiz',
        ], function () {
            Route::get('', [QuestionsController::class, 'index'])->name('.question.index');
            Route::get('create', [QuestionsController::class, 'create'])->name('.question.create');
            Route::post('', [QuestionsController::class, 'store'])->name('.question.store');
            Route::get('edit/{question}', [QuestionsController::class, 'edit'])->name('.question.edit');
            Route::patch('{question}', [QuestionsController::class, 'update'])->name('.question.update');
            Route::delete('{question}', [QuestionsController::class, 'remove'])->name('.question.delete');
            Route::get('{question}', [QuestionsController::class, 'show'])->name('.question.show');

            Route::group([
                'prefix' => '{question}/answers',
                'as' => '.answers',
            ], function () {
                Route::get('create', [AnswersController::class, 'create'])->name('.create');
                Route::post('', [AnswersController::class, 'store'])->name('.store');
                Route::get('edit/{answer}', [AnswersController::class, 'edit'])->name('.edit');
                Route::patch('{answer}', [AnswersController::class, 'update'])->name('.update');
                Route::delete('{answer}', [AnswersController::class, 'remove'])->name('.delete');
            });
        });
    });

    // Dummy route
    Route::get('#', fn() => view('welcome'))->name('#');
});
