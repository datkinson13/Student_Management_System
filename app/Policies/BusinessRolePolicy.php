<?php

namespace App\Policies;

use App\User;
use App\BusinessRole;
use GuzzleHttp\Psr7\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessRolePolicy
{
    use HandlesAuthorization;

    const policyFor = "businessrole";

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
     * Determine whether the user can view the businessRole.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        // Only businesses can access this feature.
        if ($user->isEmployer()) {
            return true;
        }

        // Otherwise return if the user specifically has this permission.
        // return ($user->hasAccess(['user.delete']));
    }

    /**
     * Determine whether the user can create businessRoles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Only businesses can access this feature.
        return $user->isEmployer();
    }

    /**
     * Determine whether the user can update the businessRole.
     *
     * @param  \App\User  $user
     * @param  \App\BusinessRole  $businessRole
     * @return mixed
     */
    public function update(User $user, BusinessRole $businessRole)
    {
        // Only businesses can access this feature.
        return $user->isEmployer();
    }

    /**
     * Determine whether the user can delete the businessRole.
     *
     * @param  \App\User  $user
     * @param  \App\BusinessRole  $businessRole
     * @return mixed
     */
    public function delete(User $user, BusinessRole $businessRole)
    {
        // Only businesses can access this feature.
        return $user->isEmployer();
    }
}
