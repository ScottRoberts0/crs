<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFileCollumnsToCopy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('copies', function (Blueprint $table) {
            $table->string("file2");
            $table->string("file3");
            $table->string("file4");
            $table->string("file5");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('copy', function (Blueprint $table) {
            Schema::dropIfExists('file2');
            Schema::dropIfExists('file3');
            Schema::dropIfExists('file4');
            Schema::dropIfExists('file5');
        });
    }
}
