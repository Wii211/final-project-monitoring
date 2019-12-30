<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_requirements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_result')->nullable();
            $table->unsignedInteger('final_log_id');
            $table->timestamps();

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
        Schema::dropIfExists('final_requirements');
    }
}
