<?php

namespace App\Policies;

use App\User;
use App\CompetencyMonitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompetencyMonitorPolicy
{
    use HandlesAuthorization;

    const policyFor = "competencymonitor";

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
     * Determine whether the user can view the competencyMonitor.
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
}
