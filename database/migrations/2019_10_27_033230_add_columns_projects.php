<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function($table) {
            $table->string('location')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->text('description')->nullable();
            $table->text('ticketType')->nullable();
            $table->text('costInclude')->nullable();
            $table->string('totalTickets')->nullable();
            $table->string('doorTickets')->nullable();
            $table->string('cheaque')->nullable();
            $table->date('regStartDate')->nullable();
            $table->date('regEndDate')->nullable();
            $table->string('regStartTime')->nullable();
            $table->string('regEndTime')->nullable();
            $table->text('contact')->nullable();
            $table->string('incomeCode')->nullable();
            $table->string('expenseLine')->nullable();
            $table->text('customMSG')->nullable();
            $table->text('specInfo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('location');
            $table->dropColumn('startDate');
            $table->dropColumn('endDate');
            $table->dropColumn('startTime');
            $table->dropColumn('endTime');
            $table->dropColumn('description');
            $table->dropColumn('ticketType');
            $table->dropColumn('costInclude');
            $table->dropColumn('totalTickets');
            $table->dropColumn('doorTickets');
            $table->dropColumn('cheaque');
            $table->dropColumn('regStartDate');
            $table->dropColumn('regEndDate');
            $table->dropColumn('regStartTime');
            $table->dropColumn('regEndTime');
            $table->dropColumn('contact');
            $table->dropColumn('incomeCode');
            $table->dropColumn('expenseLine');
            $table->dropColumn('customMSG');
            $table->dropColumn('specInfo');
    }
}
