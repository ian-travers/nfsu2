<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_completed')->default(false);
            $table->string('track1_id');
            $table->string('track2_id')->nullable();
            $table->string('track3_id')->nullable();
            $table->string('track4_id')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
