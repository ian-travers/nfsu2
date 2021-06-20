<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeasonSettings extends Settings
{
    public int $index;
    public bool $suspend;

    public static function group(): string
    {
        return 'season';
    }
}
