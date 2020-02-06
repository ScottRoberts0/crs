<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')
                ->references('id')->on('statuses')
                ->onDelete('cascade');
            $table->string('docket')->nullable();
            $table->date('due_date');
            $table->integer('copies');
            $table->string("papersize");
            $table->string("papertype");
            $table->string("papercolour");
            $table->text("finishing")->nullable();
            $table->text("information")->nullable();
            $table->string("file");
            $table->boolean("distribute")->default(0);
            $table->string("distribute_ammount")->nullable();
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
        Schema::dropIfExists('copies');
    }
}
