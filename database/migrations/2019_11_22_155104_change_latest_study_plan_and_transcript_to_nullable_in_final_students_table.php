<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLatestStudyPlanAndTranscriptToNullableInFinalStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('final_students', function (Blueprint $table) {
            $table->string('latest_study_plan')->nullable()->change();
            $table->string('transcript')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nullable_in_final_students', function (Blueprint $table) {
            //
        });
    }
}
