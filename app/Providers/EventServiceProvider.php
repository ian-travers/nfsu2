<?php

namespace App\Providers;

use App\Events\CommentDeleted;
use App\Events\CommentLeft;
use App\Events\CompetitionCompleted;
use App\Events\LikedOrDisliked;
use App\Events\PostPublished;
use App\Events\PostUnpublished;
use App\Events\SeasonCompleted;
use App\Events\TourneyCompleted;
use App\Events\TourneyCreated;
use App\Events\UnlikedOrUndisliked;
use App\Listeners\Comment;
use App\Listeners\Competition;
use App\Listeners\Like;
use App\Listeners\Post;
use App\Listeners\Season;
use App\Listeners\Tourney;
use App\Listeners\User\CreateNewsItemWhenRegistered;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            CreateNewsItemWhenRegistered::class,
        ],

        TourneyCreated::class => [
            Tourney\GainSitePoints::class,
            Tourney\NotifyUsersWhenCreated::class,
            Tourney\CreateNewsItemWhenCreated::class,
        ],

        TourneyCompleted::class => [
            Tourney\UpdateUsersTourneyCountersAndSitePoints::class,
            Tourney\RewardTourneyWinners::class,
            Tourney\UpdateSeasonPlayers::class,
            Tourney\CreateNewsItemWhenCompleted::class,
        ],

        CompetitionCompleted::class => [
            Competition\ArchiveRacers::class,
            Competition\UpdateUsersCountersAndSitePoints::class,
            Competition\RewardCompetitionWinners::class,
            Competition\UpdateSeasonStatistics::class,
        ],

        SeasonCompleted::class => [
            Season\RewardSeasonWinners::class
        ],

        PostPublished::class => [
            Post\GainSitePoints::class,
            Post\NotifyUsers::class,
        ],

        PostUnpublished::class => [
            Post\LoseSitePoints::class,
        ],

        CommentLeft::class => [
            Comment\GainSitePoints::class,
        ],

        CommentDeleted::class => [
            Comment\LoseSitePoints::class,
        ],

        LikedOrDisliked::class => [
            Like\GainSitePoints::class,
        ],

        UnlikedOrUndisliked::class => [
            Like\LoseSitePoints::class,
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
