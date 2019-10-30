<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsReportImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_report_images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('image');

            $table->unsignedInteger('news_report_id');

            $table->foreign('news_report_id')
                ->references('id')->on('news_reports')
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
        Schema::dropIfExists('news_report_images');
    }
}
