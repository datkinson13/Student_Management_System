<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnrollmentFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            // This column was originally facilitator_id. We can determine the facilitator via the course.
            $table->dropColumn('user_id');
            // We can determine who the employer is via the user. They may not even have an employer.
            $table->dropColumn('employer_id');
            // When it comes to enrollments we really only care about which user is enrolling into what course.
            $table->renameColumn('employee_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->renameColumn('user_id', 'employee_id');
            $table->integer('user_id')->unsigned();
            $table->integer('employer_id')->unsigned();
        });
    }
}
