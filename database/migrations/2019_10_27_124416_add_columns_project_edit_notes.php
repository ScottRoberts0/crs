<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsProjectEditNotes extends Migration
{
    public function up()
    {
        Schema::table('project_edit_notes', function($table) {
            $table->text('content')->nullable();
            $table->unsignedBigInteger('project_id')->default(1);
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('content');
    }
}
