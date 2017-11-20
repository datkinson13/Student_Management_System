<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'employer_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function employer() {
        return $this->belongsTo(Employer::class);
    }
}
