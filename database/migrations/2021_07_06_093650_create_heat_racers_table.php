<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeatRacersTable extends Migration
{
    public function up()
    {
        Schema::create('heat_racers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('heat_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('order');
            $table->string('racer_username', 16);
            $table->unsignedTinyInteger('place')->default(0);
            $table->unsignedSmallInteger('pts')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('heat_racers');
    }
}
