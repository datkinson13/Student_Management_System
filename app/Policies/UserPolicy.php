<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    const policyFor = "user";

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
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->id === $model->id) {
            // Let me view myself.
            return true;
        }

        if ($user->isEmployer()) {
            if ($model->employer->id === $user->employer->id) {
                // Allow employers to view employee details.
                return true;
            }
        }

        // If all else fails, does the user have a special permission allowing them to view users?
        // return ($user->hasAccess(['user.view']));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->hasAccess(['user.view']));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if ($user->id === $model->id) {
            // Let me edit myself.
            return true;
        }

        if ($user->isEmployer()) {
            if ($model->employer->id === $user->employer->id) {
                // Allow employers to edit employee details.
                return true;
            }
        }

        // If all else fails, does the user have a special permission allowing them to edit users?
        // return ($user->hasAccess(['user.edit']));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->id === $model->id) {
            // Let me delete myself.
            // but only if I'm not an employee.
            if (!$user->isEmployee()) {
                return true;
            }
        }

        if ($user->isEmployer()) {
            if ($model->employer->id === $user->employer->id) {
                // Allow employers to delete employees.
                return true;
            }
        }

        // If all else fails, does the user have a special permission allowing them to delete users?
        // return ($user->hasAccess(['user.delete']));
    }

    /**
     * Determine whether the user can edit the models permissions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function permissions(User $user)
    {
        // return ($user->hasAccess(['user.permissions']));
    }
}
