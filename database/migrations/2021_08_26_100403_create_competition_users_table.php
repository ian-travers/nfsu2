<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionUsersTable extends Migration
{
    public function up()
    {
        Schema::create('competition_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('place');
            $table->string('username', 16);
            $table->string('car', 50);
            $table->string('result');
            $table->unsignedTinyInteger('pts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competition_users');
    }
}
