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
            $table->dropForeign(['facilitator_id']); // Remove the foreign constraints
            $table->dropForeign(['employer_id']); // Remove the foreign constraints
            $table->dropForeign(['employee_id']); // Remove the foreign constraints
            // This column was originally facilitator_id. We can determine the facilitator via the course.
            $table->dropColumn('user_id');
            // We can determine who the employer is via the user. They may not even have an employer.
            $table->dropColumn('employer_id');
            // When it comes to enrollments we really only care about which user is enrolling into what course.
            $table->renameColumn('employee_id', 'user_id');
            $table->string('enrolment_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
