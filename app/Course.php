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
}
