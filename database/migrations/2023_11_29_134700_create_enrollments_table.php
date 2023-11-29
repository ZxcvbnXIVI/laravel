<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id('EnrollmentID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('SubjectID');
            $table->date('EnrollmentDate');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('SubjectID')->references('SubjectID')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
