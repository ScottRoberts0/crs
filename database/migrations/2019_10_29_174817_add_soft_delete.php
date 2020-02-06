<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('audiences', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('campuses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('copies', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('copy_finishings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('copy_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('demographics', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('foci', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('marital_statuses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('ministries', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('paper_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('project_edit_notes', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('project_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('pursuit_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('registration_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('scales', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('staffnets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('statuses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('task_types', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('web_edits', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
