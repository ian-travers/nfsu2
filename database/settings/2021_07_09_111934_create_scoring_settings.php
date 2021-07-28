<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateScoringSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('scoring.heat_regular_first', 5);
        $this->migrator->add('scoring.heat_regular_second', 3);
        $this->migrator->add('scoring.heat_regular_third', 2);
        $this->migrator->add('scoring.heat_regular_fourth', 1);

        $this->migrator->add('scoring.heat_final_first', 10);
        $this->migrator->add('scoring.heat_final_second', 6);
        $this->migrator->add('scoring.heat_final_third', 4);
        $this->migrator->add('scoring.heat_final_fourth', 2);
    }
}
