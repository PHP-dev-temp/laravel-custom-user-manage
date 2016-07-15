<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();
            $table->string('username', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('name', 50)->nullable();
            $table->string('password', 255);
            $table->tinyInteger('active')->default(0);
            $table->string('active_hash', 255)->nullable();
            $table->string('recover_hash', 255)->nullable();
            $table->string('remember_identifier', 255)->nullable();
            $table->string('remember_token', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
