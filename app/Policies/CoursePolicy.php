<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    const policyFor = "course";

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
     * Determine whether the user can view the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function view(User $user, Course $course)
    {
        if ($course->visible()) {
            return true;
        }

        if ($course->user_id === $user->id) {
            // This user is the creator of the course.
            return true;
        }
    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // return ($user->hasAccess(['course.create']));
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        if ($course->user_id === $user->id) {
            // This user is the creator of the course.
            return true;
        }

        // return ($user->hasAccess(['course.update']));
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(User $user, Course $course)
    {
        // return ($user->hasAccess(['course.delete']));
        if ($course->user_id === $user->id) {
            // This user is the creator of the course.
            return true;
        }
    }

    /**
     * Determine whether the user can compose an email to enrolled users.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function compose(User $user, Course $course)
    {
        if ($course->user_id === $user->id) {
            // This user is the creator of the course.
            return true;
        }
    }

    /**
     * Determine whether the user can assign who facilitates a course.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function assignFacilitator(User $user)
    {

    }

}
