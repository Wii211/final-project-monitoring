<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalLogsFkToFinalSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('final_schedules', function (Blueprint $table) {
            $table->unsignedInteger('final_log_id');

            $table->foreign('final_log_id')->references('id')->on('final_logs')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('final_logs', function (Blueprint $table) {
            //
        });
    }
}
