<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Enrollment;
use App\BusinessRole;
use DB;
use Illuminate\Http\Request;

class TrainingLiabilityController extends Controller
{
    public function index()
    {
      $business_roles = BusinessRole::all();

      $courses = [];
      $users = [];

      $immediate_total = 0;
      $today = date('d/m/y');

      foreach($business_roles as $business_role) {
        $courses[$business_role->id] = DB::select('select * from courses inner join businessrole_skills on courses.id = businessrole_skills.course_id where businessrole_skills.businessrole_id = ?', [$business_role->id]);
        $users[$business_role->id] = DB::select('select count(id) as total from businessrole_users where businessrole_users.businessrole_id = ?', [$business_role->id]);
      }

      foreach($business_roles as $business_role) {
        foreach($courses[$business_role->id] as $course) {
          foreach($users[$business_role->id] as $user) {
            $immediate_total += ($course->cost * $user->total);
          }
        }
      }

      return view('trainingliability.index', compact('business_roles', 'courses', 'users', 'immediate_total'));
    }
}
