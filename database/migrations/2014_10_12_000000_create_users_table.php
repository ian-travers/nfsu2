<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 15)->unique();
            $table->string('country', 2);
            $table->string('avatar')->nullable();
            $table->foreignId('team_id')->nullable();
            $table->string('email')->unique();
            $table->string('role', 32)->default('user');
            $table->boolean('is_admin')->default(false);
            $table->unsignedBigInteger('site_points')->default(0);
            $table->unsignedInteger('tourneys_finished_count')->default(0);
            $table->unsignedInteger('first_places')->default(0);
            $table->unsignedInteger('second_places')->default(0);
            $table->unsignedInteger('third_places')->default(0);
            $table->unsignedInteger('competitions_count')->default(0);
            $table->boolean('is_browser_notified')->default(false);
            $table->boolean('is_email_notified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
