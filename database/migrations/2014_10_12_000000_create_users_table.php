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
            $table->string('first_name')->nullable();;
            $table->string('middle_name')->nullable();;
            $table->string('last_name')->nullable();;
            $table->string('nationality');
            $table->string('country_of_residence')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('avatar_name')->nullable();
            $table->string('avatar_url')->nullable();
            $table->boolean('profile_completed')->default(false);
            $table->string('password');
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
