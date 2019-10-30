<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendationTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomendation_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('agree')->default(0);
            $table->timestamps();

            $table->unsignedInteger('user_id');

            $table->unsignedInteger('lecturer_id');

            $table->unsignedInteger('final_student_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('lecturer_id')
                ->references('id')->on('lecturers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('final_student_id')
                ->references('id')->on('final_students')
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
        Schema::dropIfExists('recomendation_title');
    }
}
