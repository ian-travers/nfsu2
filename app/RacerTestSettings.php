<?php


namespace App;


use Spatie\LaravelSettings\Settings;

class RacerTestSettings extends Settings
{
    public int $questions_count;
    public int $allowed_errors_count;

    public static function group(): string
    {
        return 'racer_test';
    }
}
