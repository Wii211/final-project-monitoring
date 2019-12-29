<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalStatusForeignRowInExaminersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('examiners', function (Blueprint $table) {
            $table->unsignedInteger('final_status_id');

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
        Schema::table('examiners', function (Blueprint $table) {
            $table->dropForeign(['final_status_id']);
            $table->dropColumn('final_status_id');
        });
    }
}
