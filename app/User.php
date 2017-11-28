<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

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
        'avatar',
        'identification',
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

    public function ticket()
    {
      return $this->hasMany(Ticket::class);
    }

    public function comment()
    {
      return $this->hasMany(Comment::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'system_roles');
    }

    public function competencies() {
        return $this->hasMany(Enrollment::class);
    }

    public function employee() {
        return $this->hasOne(Employee::class);
    }

    public function employer() {
        if ($this->isEmployer()) {
            return $this->hasOne(Employer::class);
        } else {
            return $this->employee->employer();
        }
    }

    public function isEmployer() {
        return count(Employer::where('user_id', $this->id)->get()) == 1;
    }

    public function isEmployee() {
        return count(Employee::where('user_id', $this->id)->get()) == 1;
    }

    public function monitoredCompetencies() {
        // Build a full list of all competencies that need to be monitored.
        // As an employer this will include all employees.
        if ($this->isEmployer()) {
            // Return all employees competencies.
            $competencies = new Collection(); // Create a collection to add competencies to.
            foreach ($this->employer->employees as $employee) { // Foreach employee of the employer
                // Get the employees competencies and add them to our collection
                $competencies = $competencies->merge($employee->user->competencies);
            }
        } else {
            // This user isn't an employer, return their competencies.
            $competencies = $this->competencies()->get();
        }

        // Reorder them so the soon to expire ones are first.
        // Exclude incomplete competencies.
        return $competencies->sortBy('ExpiryDate')->filter(function ($value) {
            return $value->ExpiryDate != null;
        });
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess($permissions)
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole($roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }
}
