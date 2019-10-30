<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('personnel_id'); //NIP
            $table->string('lecturer_id'); //NIDN
            $table->string('name');
            $table->string('last_education');
            $table->integer('status')->default(1);
            $table->string('phone_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('image_profile');
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
        Schema::dropIfExists('lecturers');
    }
}
