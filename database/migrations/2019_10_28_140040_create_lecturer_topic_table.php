<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturerTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_topic', function (Blueprint $table) {
            $table->unsignedInteger('lecturer_id');

            $table->unsignedInteger('topic_id');

            $table->foreign('lecturer_id')
                ->references('id')->on('lecturers')
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
        Schema::dropIfExists('lecturer_topics');
    }
}
