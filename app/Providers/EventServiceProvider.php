<?php

namespace App\Providers;

use App\Events\CompetitionCompleted;
use App\Events\SeasonCompleted;
use App\Events\TourneyCompleted;
use App\Listeners\Competition;
use App\Listeners\Season;
use App\Listeners\Tourney;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
            SendEmailVerificationNotification::class,
        ],

        TourneyCompleted::class => [
            Tourney\UpdateUsersTourneyCountersAndSitePoints::class,
            Tourney\RewardTourneyWinners::class,
            Tourney\UpdateSeasonPlayers::class,
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
