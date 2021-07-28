<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SitePointsSettings extends Settings
{
    public int $tourney_first; // place 1 = 10 sp.
    public int $tourney_second; // place 2 = 9 sp.
    public int $tourney_third; // place 3 = 8 sp.
    public int $tourney_fourth; // place 4 = 8 sp.
    public int $tourney_fifth_plus; // place 5+ = 6 sp.

    public static function group(): string
    {
        return 'site-points';
    }
}
