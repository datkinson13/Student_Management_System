<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->increments('enrollment_id');
$table->foreign('facilitator_id')->references('facilitator_id')->on('facilitator');
$table->foreign('employee_id')->references('employee_id')->on('employee');
$table->foreign('employer_id')->references('employer_id')->on('employer');
$table->foreign('class_id')->references('class_id')->on('class');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollment');
    }
}
