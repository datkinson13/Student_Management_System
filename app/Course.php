<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'subtitle', 'description', 'StartDate', 'EndDate', 'user_id', 'CourseTime'];

    protected $dates = ['StartDate', 'EndDate'];
}
