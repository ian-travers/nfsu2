<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ScoringSettings extends Settings
{
    public int $tourney_regular_first; // Regular round: place 1 = 5 pts.
    public int $tourney_regular_second; // Regular round: place 2 = 3 pts.
    public int $tourney_regular_third; // Regular round: place 3 = 2 pts.
    public int $tourney_regular_fourth; // Regular round: place 4 = 1 pts.

    public int $tourney_final_first; // Final round: place 1 = 10 pts.
    public int $tourney_final_second; // Final round: place 2 = 6 pts.
    public int $tourney_final_third; // Final round: place 3 = 4 pts.
    public int $tourney_final_fourth; // Final round: place 4 = 2 pts.

    public static function group(): string
    {
        return 'scoring';
    }
}
