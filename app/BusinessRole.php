<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessRole extends Model
{
  protected $fillable = [
      'name',
      'description',
      'users',
      'courses'
  ];
}
