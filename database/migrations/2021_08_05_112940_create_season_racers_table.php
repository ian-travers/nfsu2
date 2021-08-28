<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonRacersTable extends Migration
{
    public function up()
    {
        Schema::create('season_racers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('racer_username', 16);
            $table->unsignedInteger('season_index')->default(1);
            $table->unsignedInteger('circuit_count')->default(0);
            $table->unsignedInteger('circuit_pts')->default(0);
            $table->unsignedInteger('sprint_count')->default(0);
            $table->unsignedInteger('sprint_pts')->default(0);
            $table->unsignedInteger('drag_count')->default(0);
            $table->unsignedInteger('drag_pts')->default(0);
            $table->unsignedInteger('drift_count')->default(0);
            $table->unsignedInteger('drift_pts')->default(0);
            $table->unsignedInteger('competition_count')->default(0);
            $table->unsignedInteger('competition_pts')->default(0);

            $table->unique(['user_id', 'season_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('season_racers');
    }
}
