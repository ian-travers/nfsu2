<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDialoguesTable extends Migration
{
    public function up()
    {
        Schema::create('dialogues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initiator_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('companion_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('blocked')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dialogues');
    }
}
