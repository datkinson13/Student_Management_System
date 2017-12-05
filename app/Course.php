<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'subtitle', 'description', 'StartDate', 'EndDate', 'user_id', 'CourseTime', 'days_valid', 'cost'];

    protected $dates = ['StartDate', 'EndDate'];

    public function enrollments() {
        // Return enrollments for the course.
        return $this->hasMany(Enrollment::class);
    }

    public function visible() {
        // This will be adjusted to be a database column that will allow facilitators to make a course as ready to be enrolled into.
        return true;
    }
}
