<?php

namespace App\Providers;

use App\Events\TourneyCompleted;
use App\Listeners\AwardSitePointsAfterTourney;
use App\Listeners\RewardTourneyWinners;
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
            AwardSitePointsAfterTourney::class,
            RewardTourneyWinners::class,
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
