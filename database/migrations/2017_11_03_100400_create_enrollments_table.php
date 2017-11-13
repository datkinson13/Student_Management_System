<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facilitator_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('employer_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();
            $table->foreign('facilitator_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('employer_id')->references('id')->on('employers');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enrollments');
    }
}
