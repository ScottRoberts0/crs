<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('cascade');
            $table->string('type');
            $table->string('audience')->nullable();
            $table->string('focus')->nullable();
            $table->string('demographic')->nullable();
            $table->string('lifestyles')->nullable();
            $table->text('purpose')->nullable();
            $table->text('keymessage')->nullable();
            $table->text('walkaway')->nullable();
            $table->date('date_needed')->nullable();
            $table->date('event_date')->nullable();
            $table->string('time')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('video__dramas');
    }
}
