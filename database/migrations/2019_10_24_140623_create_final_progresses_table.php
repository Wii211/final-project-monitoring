<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_progresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('agreement')->default(0);

            $table->timestamps();

            $table->unsignedInteger('supervisor_id');

            $table->unsignedInteger('user_id');

            $table->foreign('supervisor_id')
                ->references('id')->on('supervisors')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('final_progresses');
    }
}
