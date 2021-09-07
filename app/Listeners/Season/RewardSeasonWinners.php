<?php

namespace App\Listeners\Season;

use App\ReadRepositories\SeasonHelper;

class RewardSeasonWinners
{
    public function handle($event)
    {
        SeasonHelper::rewardWinners($event->seasonIndex);
    }
}
