<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('status', 20)->default('active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
