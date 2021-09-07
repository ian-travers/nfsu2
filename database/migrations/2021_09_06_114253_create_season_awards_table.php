<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonAwardsTable extends Migration
{
    public function up()
    {
        Schema::create('season_awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('season_index');
            $table->string('type');
            $table->enum('place', [1, 2, 3]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('season_awards');
    }
}
