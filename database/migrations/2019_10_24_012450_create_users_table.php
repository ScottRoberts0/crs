<?php

use Illuminate\Support\Facades\Schema;
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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('campus_id')->unsigned();
            $table->foreign('campus_id')
                ->references('id')->on('campuses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('ministry_id')->unsigned();
            $table->foreign('ministry_id')
                ->references('id')->on('ministries')
                ->onDelete('cascade');
            $table->unsignedBigInteger('role_id')->unsigned();
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');
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
