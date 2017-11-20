<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseValid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('days_valid')->nullable();
            $table->text('description')->nullable()->change();
            $table->string('CourseTime')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('days_valid');
            $table->string('description')->nullable()->change();
            $table->timeTz('CourseTime')->change();
        });
    }
}
