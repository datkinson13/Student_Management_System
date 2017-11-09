<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Fname',
        'Lname',
        'phone',
        'mobile',
        'address',
        'DOB',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        // Load the relationship between User and Admin.
        $admin = Administrator::where('user_id', $this->id)->first();
        if ($admin === null) {
            // If admin is returned, the user is an administrator.
            return false;
        } else {
            // Otherwise they are not.
            return true;
        }
    }

    public function isFacilitator() {
        // Load the relationship between User and Facilitator.
        $facilitator = Facilitator::where('user_id', $this->id)->first();
        if ($facilitator === null) {
            // If facilitator is returned, the user is a facilitator.
            return false;
        } else {
            // Otherwise they are not.
            return true;
        }
    }
}
