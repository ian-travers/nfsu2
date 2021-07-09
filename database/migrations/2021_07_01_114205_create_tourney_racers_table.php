<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourneyRacersTable extends Migration
{
    public function up()
    {
        Schema::create('tourney_racers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('racer_username', 16);
            $table->foreignId('tourney_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('pts')->default(0);
            $table->timestamp('signed_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tourney_racers');
    }
}
