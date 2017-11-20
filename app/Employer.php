<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = ['user_id', 'company', 'address', 'phone', 'domain'];

    public function employees() {
        return $this->hasMany(Employee::class);
    }
}
