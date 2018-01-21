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
use App\TrainingLiability;
use App\CompetencyMonitor;
use App\Report;

// Policies
use App\Policies\BusinessRolePolicy;
use App\Policies\CommentPolicy;
use App\Policies\CoursePolicy;
use App\Policies\UserPolicy;
use App\Policies\EmployerPolicy;
use App\Policies\EnrollmentPolicy;
use App\Policies\TrainingLiabilityPolicy;
use App\Policies\CompetencyMonitorPolicy;
use App\Policies\ReportPolicy;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'              => 'App\Policies\ModelPolicy',
        Course::class            => CoursePolicy::class,
        BusinessRole::class      => BusinessRolePolicy::class,
        Comment::class           => CommentPolicy::class,
        User::class              => UserPolicy::class,
        Employer::class          => EmployerPolicy::class,
        Enrollment::class        => EnrollmentPolicy::class,
        TrainingLiability::class => TrainingLiabilityPolicy::class,
        CompetencyMonitor::class => CompetencyMonitorPolicy::class,
        Report::class            => ReportPolicy::class,
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
