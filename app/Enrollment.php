<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Enrollment extends Model
{
    protected $fillable = ['course_id', 'user_id', 'ExpiryDate', 'CompletedDate'];

    public function daysRemaining() {
        $expiryDate = new DateTime($this->ExpiryDate);
        $now = new DateTime('now');
        $difference = $expiryDate->diff($now);
        $days = $difference->format('%a');

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
}
