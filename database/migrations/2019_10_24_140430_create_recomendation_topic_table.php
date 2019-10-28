<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendationTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomendation_topic', function (Blueprint $table) {

            $table->unsignedInteger('recomendation_title_id');
            $table->unsignedInteger('topic_id');

            $table->foreign('recomendation_title_id')
                ->references('id')->on('recomendation_titles')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('topic_id')
                ->references('id')->on('topics')
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
        Schema::dropIfExists('recomendation_topic');
    }
}
