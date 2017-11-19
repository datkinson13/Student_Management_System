<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function employer() {
        return $this->belongsTo(Employer::class);
    }
}
