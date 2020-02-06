<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('assigned_id')->unsigned();
            $table->foreign('assigned_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->default(2);
            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('tasktype_id')->default(1);
            $table->foreign('tasktype_id')
                ->references('id')->on('task_types')
                ->onDelete('cascade');
            $table->unsignedBigInteger('campus_id')->default(1);
            $table->foreign('campus_id')
                ->references('id')->on('campuses')
                ->onDelete('cascade');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
