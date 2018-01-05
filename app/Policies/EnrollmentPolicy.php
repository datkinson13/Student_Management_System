<?php

namespace App\Policies;

use App\User;
use App\Enrollment;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentPolicy
{
    use HandlesAuthorization;

    const policyFor = "enrollment";

    public function before(User $user, $ability)
    {
        // Always return true for the administrator.
        if ($user->inRole('administrator')) {
            return true;
        }

        // Return true if the user has this specific permission.
        if ($user->hasAccess([self::policyFor . '.' . $ability])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the enrollment.
     *
     * @param  \App\User  $user
     * @param  \App\Enrollment  $enrollment
     * @return mixed
     */
    public function view(User $user, Enrollment $enrollment)
    {
        //
    }

    /**
     * Determine whether the user can create enrollments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the enrollment.
     *
     * @param  \App\User  $user
     * @param  \App\Enrollment  $enrollment
     * @return mixed
     */
    public function update(User $user, Enrollment $enrollment)
    {
        // Facilitator is the only one who can update an enrollment
        if ($enrollment->course->facilitator->id === $user->id) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the enrollment.
     *
     * @param  \App\User  $user
     * @param  \App\Enrollment  $enrollment
     * @return mixed
     */
    public function delete(User $user, Enrollment $enrollment)
    {
        //
    }
}
