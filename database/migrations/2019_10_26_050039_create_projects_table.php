<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('cascade');
            $table->boolean("events")->default(1);
            $table->string('title')->nullable();;
            $table->date('project_date')->nullable();
            $table->boolean("flex_date")->default(1);
            $table->string('project_type')->nullable();
            $table->text('notsure')->nullable();
            $table->text('usedfor')->nullable();
            $table->string('audience')->nullable();
            $table->string('scale')->nullable();
            $table->string('focus')->nullable();
            $table->string('demographic')->nullable();
            $table->string('lifestyles')->nullable();
            $table->text('event_description')->nullable();
            $table->date('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->boolean("tickets")->default(1);
            $table->string('method')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('rsvpname')->nullable();
            $table->string('rsvpemail')->nullable();
            $table->string('rsvpphone')->nullable();
            $table->string('budget')->nullable();
            $table->text('message')->nullable();
            $table->string('pursuit')->nullable();
            $table->text('support')->nullable();
            $table->text('moreinfo')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
