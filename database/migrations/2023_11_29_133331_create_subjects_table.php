<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('SubjectID');
            $table->unsignedBigInteger('CategoryID');
            $table->string('SubjectName', 255);
            $table->text('Description');
            $table->string('PlaylistLink', 255);
            $table->timestamps();
            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}

