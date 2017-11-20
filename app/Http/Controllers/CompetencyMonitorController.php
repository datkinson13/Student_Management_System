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
      $users = User::all();
      $business_roles = BusinessRole::all();
      $courses = Course::all();

      foreach($users as $user) {
        foreach($business_roles as $business_role) {
          foreach($courses as $course) {
            
          }
        }
      }

      return view('competencymonitor.index', compact('users', 'business_roles', 'courses'));
    }
}
