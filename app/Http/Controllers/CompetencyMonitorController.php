<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Enrollment;
use App\BusinessRole;
use App\Report;
use DB;
use Illuminate\Http\Request;

class CompetencyMonitorController extends Controller
{
    public function index()
    {
      // Get all users and business roles
      $users = User::paginate(1)->filter(function ($value) {
          return \Auth::user()->can('view', $value);
      });
      $all_roles = BusinessRole::all();

      $businessRoles = [];
      $courses = [];

      // Grab all relevant business roles for each user
      foreach($users as $user) {
        $businessRoles[$user->id] = DB::select('select * from business_roles inner join businessrole_users on business_roles.id = businessrole_users.businessrole_id where businessrole_users.user_id = ?', [$user->id]);
      }

      // Grab all courses for each business role
      foreach($all_roles as $role) {
        $courses[$role->id] = DB::select('select * from courses inner join businessrole_skills on courses.id = businessrole_skills.course_id where businessrole_skills.businessrole_id = ?', [$role->id]);
      }

      // Grab all appropriate enrolments for timeline generation
      $enrolments = DB::select('select * from enrollments where enrollment_status = "Completed" or enrollment_status = "Expired"');

      return view('competencymonitor.index', compact('users', 'businessRoles', 'courses', 'enrolments'));
    }
}
