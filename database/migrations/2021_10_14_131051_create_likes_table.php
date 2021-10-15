<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->morphs('likeable');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('type_id', ['like', 'dislike'])->default('like');
            $table->timestamps();

            $table->unique(['likeable_id', 'likeable_type', 'user_id'], 'like_user_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
