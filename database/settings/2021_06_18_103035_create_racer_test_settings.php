<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateRacerTestSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('racer_test.questions_count', 6);
        $this->migrator->add('racer_test.allowed_errors_count', 0);
    }
}
