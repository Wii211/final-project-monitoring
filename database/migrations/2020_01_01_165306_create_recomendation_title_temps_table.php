<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendationTitleTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomendation_title_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supervisor_1_id')->nullable();
            $table->string('supervisor_2_id')->nullable();

            $table->unsignedInteger('recomendation_title_id');

            $table->foreign('recomendation_title_id')->references('id')
                ->on('recomendation_titles')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('recomendation_title_temps');
    }
}
