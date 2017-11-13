<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'ticket_id',
      'user_id',
      'body'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [

  ];

    public function ticket()
    {
      return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
