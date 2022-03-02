<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('surname', 255)->nullable(false);
            $table->string('email', 255)->nullable(false)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable(false);
            $table->boolean('is_admin');
            $table->string('role');
            $table->string('study_group');
            $table->string('tracker_id');
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
