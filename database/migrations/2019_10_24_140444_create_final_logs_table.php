<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('final_project_id');

            $table->unsignedInteger('final_status_id');

            $table->foreign('final_project_id')
                ->references('id')->on('final_projects')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('final_status_id')
                ->references('id')->on('final_statuses')
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
        Schema::dropIfExists('final_logs');
    }
}
