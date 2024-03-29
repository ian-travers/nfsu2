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

    public int $competition; // 10 sp.
    public int $post; // 150 sp.
    public int $comment; // 10 sp.
    public int $like_dislike; // 1 sp.

    public int $create_tourney; // 100 sp.
    public int $pass_racer_test; // 25 sp.

    public int $create_team; // 50 sp.
    public int $join_team; // 5 sp.

    public static function group(): string
    {
        return 'site-points';
    }
}
