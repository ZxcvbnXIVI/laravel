<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id('VideoID'); // Auto-incremental primary key
            $table->unsignedBigInteger('SubjectID');
            $table->unsignedBigInteger('CategoryID');
            $table->string('VideoTitle', 255);
            $table->string('VideoURL', 255);
            $table->string('Thumbnail');
            $table->string('VideoCode', 255);
            $table->string('ChannelName');
            $table->timestamps(); // Created at and Updated at timestamps
            $table->foreign('SubjectID')->references('SubjectID')->on('subjects');
            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
