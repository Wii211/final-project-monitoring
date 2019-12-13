<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyInFinalProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('final_progresses', function (Blueprint $table) {
            $table->dropForeign('final_progresses_supervisor_id_foreign');
            $table->dropForeign('final_progresses_user_id_foreign');
            $table->dropColumn(['supervisor_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('final_progresses', function (Blueprint $table) {
            //
        });
    }
}
