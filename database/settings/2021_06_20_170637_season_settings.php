<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class SeasonSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('season.index', 1);
        $this->migrator->add('season.suspend', false);
    }
}
