<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videoLinkcategory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('VideoID');
            $table->unsignedBigInteger('CategoryID');
            $table->timestamps();
        
            // กำหนดความสัมพันธ์กับตาราง videos
            $table->foreign('VideoID')->references('VideoID')->on('videos');
        
            // กำหนดความสัมพันธ์กับตาราง categories
            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        
            // ป้องกันการสร้างคู่ซ้ำ
            $table->unique(['VideoID', 'CategoryID']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_category');
    }
}
