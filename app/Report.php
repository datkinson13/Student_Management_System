<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $fillable = [
      'report_name',
      'report_entity',
      'type',
      'label',
      'data',
      'options'
  ];

  
}
