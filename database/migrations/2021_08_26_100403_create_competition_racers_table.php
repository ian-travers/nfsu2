<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionRacersTable extends Migration
{
    public function up()
    {
        Schema::create('competition_racers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('username', 16);
            $table->unsignedTinyInteger('place');
            $table->string('car', 50);
            $table->string('result');
            $table->unsignedInteger('pts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competition_racers');
    }
}
