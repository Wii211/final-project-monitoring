<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role');
            $table->timestamps();

            $table->unsignedInteger('final_project_id');
            $table->unsignedInteger('lecturer_id');

            $table->foreign('final_project_id')
                ->references('id')->on('final_projects')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('lecturer_id')
                ->references('id')->on('lecturers')
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
        Schema::dropIfExists('supervisors');
    }
}
