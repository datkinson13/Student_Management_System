<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// Models
use App\BusinessRole;
use App\Comment;
use App\Course;
use App\User;
use App\Employer;
use App\Enrollment;

// Policies
use App\Policies\BusinessRolePolicy;
use App\Policies\CommentPolicy;
use App\Policies\CoursePolicy;
use App\Policies\UserPolicy;
use App\Policies\EmployerPolicy;
use App\Policies\EnrollmentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'         => 'App\Policies\ModelPolicy',
        Course::class       => CoursePolicy::class,
        BusinessRole::class => BusinessRolePolicy::class,
        Comment::class      => CommentPolicy::class,
        User::class         => UserPolicy::class,
        Employer::class     => EmployerPolicy::class,
        Enrollment::class   => EnrollmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
