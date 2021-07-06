<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeatsTable extends Migration
{
    public function up()
    {
        Schema::create('heats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourney_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('round');
            $table->unsignedTinyInteger('heat_no');
        });
    }

    public function down()
    {
        Schema::dropIfExists('heats');
    }
}
