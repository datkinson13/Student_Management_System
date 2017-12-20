<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Carbon\Carbon;

class Enrollment extends Model
{
    protected $fillable = ['course_id', 'user_id', 'ExpiryDate', 'CompletedDate'];

    public $color = "blue";

    public function daysRemaining() {
        $expiryDate = new DateTime($this->ExpiryDate);
        $now = new DateTime('now');
        $difference = $now->diff($expiryDate);
        $days = $difference->format('%R%a');

        return $days;
    }

    public function competencyStatus() {
        if ($this->daysRemaining() < 30) {
            $level = ['color' => "RED", 'light' => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=="];
        } elseif ($this->daysRemaining() < 90) {
            $level = ['color' => "YELLOW", "light" => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8P5fhPwAG3AKdTosUcwAAAABJRU5ErkJggg=="];
        } else {
            $level = ['color' => "GREEN", 'light' => "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkWMrwHwAC+AGmhtOH1AAAAABJRU5ErkJggg=="];
        }

        return $level;
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * Turn the enrollment item into an FullCalendar event
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
        return $this->course->name;
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
        return new Carbon($this->CompletedDate);
    }

    /**
     * Get the end time
     *
     * @return Carbon
     */
    public function getEnd()
    {
        return new Carbon($this->ExpiryDate);
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
