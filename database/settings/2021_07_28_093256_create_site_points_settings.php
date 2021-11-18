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

        $this->migrator->add('site-points.competition', 10);
        $this->migrator->add('site-points.post', 150);
        $this->migrator->add('site-points.comment', 10);
        $this->migrator->add('site-points.like_dislike', 1);

        $this->migrator->add('site-points.create_tourney', 50);
    }
}
