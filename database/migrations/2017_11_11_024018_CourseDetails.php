<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('facilitator_id', 'user_id');
            $table->string('name')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('description')->nullable();
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
            $table->renameColumn('user_id', 'facilitator_id');
            $table->dropColumn('name');
            $table->dropColumn('subtitle');
            $table->dropColumn('description');
        });
    }
}
