<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id('ProgressID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('VideoID');
            $table->double('ProgressPercentage');
            $table->timestamps();
            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('VideoID')->references('VideoID')->on('videos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
