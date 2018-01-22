<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model implements \MaddHatter\LaravelFullcalendar\Event {

    use SoftDeletes;

    protected $fillable = ['name', 'subtitle', 'description', 'StartDate', 'EndDate', 'user_id', 'CourseTime', 'days_valid', 'cost'];

    protected $dates = ['StartDate', 'EndDate', 'start', 'end', 'deleted_at'];

    public $color = 'blue';

    public function enrollments()
    {
        // Return enrollments for the course.
        return $this->hasMany(Enrollment::class);
    }

    public function visible()
    {
        // This will be adjusted to be a database column that will allow facilitators to make a course as ready to be enrolled into.
        return true;
    }

    public function facilitator()
    {
        // Return the facilitator
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     *
     * Turn the course item into an FullCalendar event
     * https://github.com/maddhatter/laravel-fullcalendar
     *
     */

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->name;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        // return (bool) $this->all_day;
        // Hardcoded False for now.
        return false;
    }

    /**
     * Get the start time
     *
     * @return Carbon
     */
    public function getStart()
    {
        return new Carbon($this->StartDate);
    }

    /**
     * Get the end time
     *
     * @return Carbon
     */
    public function getEnd()
    {
        return new Carbon($this->EndDate);
    }

    /**
     * Optional FullCalendar.io settings for this event
     *
     * @return array
     */
    public function getEventOptions()
    {
        return [
            'color' => $this->color,
        ];
    }
}
