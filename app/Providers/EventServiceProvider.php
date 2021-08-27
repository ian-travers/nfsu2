<?php

namespace App\Providers;

use App\Events\CompetitionCompleted;
use App\Events\TourneyCompleted;
use App\Listeners\Competition\ArchiveRacers;
use App\Listeners\Competition\RewardCompetitionWinners;
use App\Listeners\Competition\UpdateUsersCountersAndSitePoints;
use App\Listeners\RewardTourneyWinners;
use App\Listeners\UpdateSeasonPlayers;
use App\Listeners\UpdateUsersTourneyCountersAndSitePoints;
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
            UpdateUsersTourneyCountersAndSitePoints::class,
            RewardTourneyWinners::class,
            UpdateSeasonPlayers::class,
        ],

        CompetitionCompleted::class => [
            ArchiveRacers::class,
            UpdateUsersCountersAndSitePoints::class,
            RewardCompetitionWinners::class,
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
