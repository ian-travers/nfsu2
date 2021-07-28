<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSitePointsSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site-points.tourney_first', 10);
        $this->migrator->add('site-points.tourney_second', 9);
        $this->migrator->add('site-points.tourney_third', 8);
        $this->migrator->add('site-points.tourney_fourth', 8);
        $this->migrator->add('site-points.tourney_fifth_plus', 6);
    }
}
