<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusinessroleSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessrole_skills', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('course_id');
          $table->unsignedInteger('businessrole_id');
          $table->timestamps();

          $table->unique(['course_id','businessrole_id']);
          $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
          $table->foreign('businessrole_id')->references('id')->on('business_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businessrole_skills');
    }
}
