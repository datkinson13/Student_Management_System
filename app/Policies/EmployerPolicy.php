<?php

namespace App\Policies;

use App\User;
use App\Employer;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
{
    use HandlesAuthorization;

    const policyFor = "employer";

    public function before(User $user, $ability)
    {
        if ($user->inRole('administrator')) {
            return true;
        }

        // Return true if the user has this specific permission.
        if ($user->hasAccess([self::policyFor . '.' . $ability])) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function view(User $user, Employer $employer)
    {
        if ($employer->id === $user->employer->id) {
            // This user is a member of this business.
            return true;
        }
    }

    /**
     * Determine whether the user can create employers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Allow this unless the User is already a member of a business.
        if (!($user->isEmployer() || $user->isEmployee())) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function update(User $user, Employer $employer)
    {
        // Only allow this if the user is the business owner.
        if ($user->isEmployer() && ($user->employer->id === $employer->id)) {
            // This user is the business owner.
            return true;
        }
    }

    /**
     * Determine whether the user can delete the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function delete(User $user, Employer $employer)
    {
        // Only allow this if the user is the business owner.
        if ($user->isEmployer() && ($user->employer->id === $employer->id)) {
            // This user is the business owner.
            return true;
        }
    }
}
