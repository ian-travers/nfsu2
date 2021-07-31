<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrophiesTable extends Migration
{
    public function up()
    {
        Schema::create('trophies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('trophiable');
            $table->enum('place', [1, 2, 3]);
        });
    }

    public function down()
    {
        Schema::dropIfExists('trophies');
    }
}
