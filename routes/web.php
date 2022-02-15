<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Backend\CommentsController;
use App\Http\Controllers\Backend\CompetitionsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DialoguesController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PostsController;
use App\Http\Controllers\Backend\Quiz\AnswersController;
use App\Http\Controllers\Backend\Quiz\QuestionsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\CompetitionsController as ReadCompetitionsController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\NewsReadController;
use App\Http\Controllers\NFSUServerController;
use App\Http\Controllers\PostsReadController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\SeasonsArchiveController;
use App\Http\Controllers\SeasonStandingsController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\Tests\RacerController;
use App\Http\Controllers\TourneysController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\Cabinet\CabinetController;
use App\Http\Controllers\User\Cabinet\DialoguesController as CabinetDialoguesController;
use App\Http\Controllers\User\Cabinet\HandleTourneyController as CabinetHandleTourneyController;
use App\Http\Controllers\User\Cabinet\PostsController as CabinetPostsController;
use App\Http\Controllers\User\Cabinet\TourneysController as CabinetTourneysController;
use App\Http\Controllers\User\Team\CreateTeamController;
use App\Http\Controllers\User\Team\EditTeamController;
use App\Http\Controllers\User\Team\JoinTeamController;
use App\Http\Controllers\User\Team\ManageTeamController;
use App\Http\Controllers\User\UserNotificationsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\User\NotificationsSettings;
use App\Http\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'language'], function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('home');

    Route::get('rules', [RulesController::class, 'show'])->name('rules');
    Route::post('rules', [RulesController::class, 'check'])->name('rules-check');

    Route::group([
        'prefix' => 'news',
        'as' => 'news',
    ], function () {
        Route::get('', [NewsReadController::class, 'index'])->name('.index');
        Route::get('{newsitem:slug}', [NewsReadController::class, 'show'])->name('.view');
    });

    Route::group([
        'prefix' => 'blog',
        'as' => 'blog',
    ], function () {
        Route::get('', [PostsReadController::class, 'index'])->name('.index');
        Route::get('{post:slug}', [PostsReadController::class, 'show'])->name('.view');
    });

    Route::group([
        'prefix' => 'seasons-archive',
        'as' => 'seasons-archive',
    ], function () {
        Route::get('', [SeasonsArchiveController::class, 'index'])->name('.index');
        Route::get('{season}', [SeasonsArchiveController::class, 'show'])->name('.show');
    });

    Route::group([
        'prefix' => 'competitions',
        'as' => 'competitions',
    ], function () {
        Route::get('', [ReadCompetitionsController::class, 'index'])->name('.index');
        Route::get('archive', [ReadCompetitionsController::class, 'archive'])->name('.archive');
        Route::get('{competition}', [ReadCompetitionsController::class, 'show'])->name('.show');
    });

    Route::group([
        'prefix' => 'tourneys',
        'as' => 'tourneys',
    ], function () {
        Route::get('', [TourneysController::class, 'index'])->name('.index');
        Route::get('archive', [TourneysController::class, 'archive'])->name('.archive');
        Route::get('{tourney}', [TourneysController::class, 'show'])->name('.show');
    });

    Route::group([
        'prefix' => 'season-standings',
        'as' => 'season-standings',
    ], function () {
        Route::get('tourney-personal', [SeasonStandingsController::class, 'tourneyPersonal'])->name('.tourney-personal');
        Route::get('tourney-countries', [SeasonStandingsController::class, 'tourneyCountries'])->name('.tourney-countries');
        Route::get('tourney-teams', [SeasonStandingsController::class, 'tourneyTeam'])->name('.tourney-teams');
        Route::get('competition-personal', [SeasonStandingsController::class, 'competitionPersonal'])->name('.competition-personal');
    });

    Route::group([
        'middleware' => 'auth',
        'prefix' => 'tests',
        'as' => 'tests',
    ], function () {
        Route::get('racer', [RacerController::class, 'show'])->name('.racer.show');
        Route::post('racer', [RacerController::class, 'check'])->name('.racer.check');
    });

    Route::get('players', [PublicProfileController::class, 'index'])->name('players-list');
    Route::get('players/{user:username}', [PublicProfileController::class, 'show'])->name('public-profile');
    Route::get('teams/{team:clan}', [TeamsController::class, 'show'])->name('team-profile');

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
        Route::get('forgot-password', [PasswordResetController::class, 'create'])->name('.request');
        Route::post('forgot-password', [PasswordResetController::class, 'store'])->name('.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('.update');
    });

    // User notifications
    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'notifications',
        'as' => 'notifications',
    ], function () {
        Route::get('', [UserNotificationsController::class, 'index'])->name('.index');
        Route::delete('{notification}', [UserNotificationsController::class, 'remove'])->name('.delete');
        Route::put('{notification}', [UserNotificationsController::class, 'toggleRead'])->name('.toggleRead');
    });

    // User settings
    Route::group([
        'middleware' => ['auth'],
        'prefix' => 'settings',
        'as' => 'settings'
    ], function () {
        Route::get('profile', Profile::class)->name('.profile');
        Route::get('account', [AccountController::class, 'show'])->name('.account');
        Route::get('notifications', NotificationsSettings::class)->name('.notifications');

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
        // Cabinet tourneys CRUD
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
                Route::patch('{tourney}/clean-final-heat', [CabinetHandleTourneyController::class, 'clearFinalHeat'])->name('.clean-final-heat');
            });
        });
        // Cabinet posts CRUD
        Route::group([
            'prefix' => 'posts',
            'as' => '.posts'
        ], function () {
            Route::get('', [CabinetPostsController::class, 'index'])->name('.index');
            Route::get('create', [CabinetPostsController::class, 'create'])->name('.create');
            Route::post('', [CabinetPostsController::class, 'store'])->name('.store');
            Route::get('{post}', [CabinetPostsController::class, 'show'])->name('.view');
            Route::get('{post}/edit', [CabinetPostsController::class, 'edit'])->name('.edit');
            Route::patch('{post}', [CabinetPostsController::class, 'update'])->name('.update');
            Route::delete('{post}', [CabinetPostsController::class, 'trash'])->name('.delete');
            Route::patch('{post}/restore', [CabinetPostsController::class, 'restore'])->name('.restore');
            // Handle the post
            Route::patch('{post}/publish', [CabinetPostsController::class, 'publish'])->name('.publish');
            Route::patch('{post}/unpublish', [CabinetPostsController::class, 'unpublish'])->name('.unpublish');
        });

        // Cabinet messages CRUD
        Route::group([
            'prefix' => 'dialogues',
            'as' => '.dialogues'
        ], function () {
            Route::get('', [CabinetDialoguesController::class, 'index'])->name('.index');
            Route::post('{username}', [CabinetDialoguesController::class, 'store'])->name('.store');
            Route::patch('{username}/block', [CabinetDialoguesController::class, 'block'])->name('.block');
            Route::get('{dialogue}', [CabinetDialoguesController::class, 'show'])->name('.show');
            Route::put('{dialogue}', [CabinetDialoguesController::class, 'addMessage'])->name('.add-message');
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

        // Competitions
        Route::group([
            'prefix' => 'competitions',
            'as' => '.competitions',
        ], function () {
            Route::get('', [CompetitionsController::class, 'index'])->name('.index');
            Route::get('create', [CompetitionsController::class, 'create'])->name('.create');
            Route::post('', [CompetitionsController::class, 'store'])->name('.store');
            Route::get('edit/{competition}', [CompetitionsController::class, 'edit'])->name('.edit');
            Route::patch('{competition}', [CompetitionsController::class, 'update'])->name('.update');
            Route::delete('{competition}', [CompetitionsController::class, 'remove'])->name('.delete');
        });

        // News
        Route::group([
            'prefix' => 'news',
            'as' => '.news',
        ], function () {
            Route::get('', [NewsController::class, 'index'])->name('.index');
            Route::get('create', [NewsController::class, 'create'])->name('.create');
            Route::post('', [NewsController::class, 'store'])->name('.store');
            Route::get('{newsitem}', [NewsController::class, 'show'])->name('.view');
            Route::get('{newsitem}/edit', [NewsController::class, 'edit'])->name('.edit');
            Route::patch('{newsitem}', [NewsController::class, 'update'])->name('.update');
            Route::delete('{newsitem}', [NewsController::class, 'remove'])->name('.delete');
        });

        // Posts
        Route::group([
            'prefix' => 'posts',
            'as' => '.posts',
        ], function () {
            Route::get('', [PostsController::class, 'index'])->name('.index');
            Route::get('create', [PostsController::class, 'create'])->name('.create');
            Route::post('', [PostsController::class, 'store'])->name('.store');
            Route::get('{post}', [PostsController::class, 'show'])->name('.view');
            Route::get('{post}/edit', [PostsController::class, 'edit'])->name('.edit');
            Route::patch('{post}', [PostsController::class, 'update'])->name('.update');
            Route::delete('{post}', [PostsController::class, 'remove'])->name('.delete');
            Route::delete('{post}/force-delete', [PostsController::class, 'forceRemove'])->name('.force-delete');
            Route::patch('{post}/restore', [PostsController::class, 'restore'])->name('.restore');
            Route::patch('{post}/publish', [PostsController::class, 'publish'])->name('.publish');
            Route::patch('{post}/unpublish', [PostsController::class, 'unpublish'])->name('.unpublish');
        });

        // Comments
        Route::group([
            'prefix' => 'comments',
            'as' => '.comments',
        ], function () {
            Route::get('', [CommentsController::class, 'index'])->name('.index');
            Route::get('edit/{comment}', [CommentsController::class, 'edit'])->name('.edit');
            Route::patch('{comment}', [CommentsController::class, 'update'])->name('.update');
            Route::delete('{comment}', [CommentsController::class, 'remove'])->name('.delete');
        });

        // Dialogues
        Route::group([
            'prefix' => 'dialogues',
            'as' => '.dialogues',
        ], function () {
            Route::get('', [DialoguesController::class, 'index'])->name('.index');
            Route::get('{dialogue}', [DIaloguesController::class, 'show'])->name('.show');
        });
    });

    // Dummy route
    Route::get('#', fn() => view('welcome'))->name('#');

    // Static pages. Should be at the bottom
    Route::view('gameplay', 'gameplay')->name('gameplay');
    Route::view('faq', 'faq')->name('faq');

    Route::get('downloads/{filename}', DownloadsController::class)
        ->name('downloads')
        ->where('filename', 'nfsu|nfsu-client|nfsu-save|nfsu-save-patcher');

    Route::get('information/{page}', StaticPagesController::class)
        ->name('page')
        ->where('page', 'tourneys|competitions|nfsu-cup|nfsu-server');
});
