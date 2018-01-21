<?php

namespace App\Policies;

use App\User;
use App\TrainingLiability;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingLiabilityPolicy
{
    use HandlesAuthorization;

    const policyFor = "trainingliability";

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
     * Determine whether the user can view the trainingLiability.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        if ($user->isEmployer()) {
            return true;
        }
    }

    /**
     * Determine whether the user can create trainingLiability emails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function email(User $user)
    {
        if ($user->isEmployer()) {
            return true;
        }
    }
}
