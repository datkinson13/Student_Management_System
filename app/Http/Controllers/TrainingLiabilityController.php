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

      $red_enrolments = [];
      $yellow_enrolments = [];
      $green_enrolments = [];

      $pending_enrolments = [];
      $completed_enrolments = [];

      $immediate_course_cost = [];
      $approaching_course_cost = [];
      $distant_course_cost = [];

      $immediate_total = 0;
      $approaching_total = 0;
      $distant_total = 0;


      $today = date('Y-m-d');
      $ninetyDaysLimit = date('Y-m-d', strtotime($today. ' + 90 days'));

      foreach($business_roles as $business_role) {
        $courses[$business_role->id] = DB::select('select * from courses inner join businessrole_skills on courses.id = businessrole_skills.course_id where businessrole_skills.businessrole_id = ?', [$business_role->id]);
        $users[$business_role->id] = DB::select('select count(id) as total from businessrole_users where businessrole_users.businessrole_id = ?', [$business_role->id]);

        foreach($courses[$business_role->id] as $course) {

          $red_enrolments["$business_role->id-$course->course_id"] = DB::select("
          select count(distinct enrollments.user_id) as total
          from enrollments
          join businessrole_skills on enrollments.course_id = businessrole_skills.course_id
          join businessrole_users on enrollments.user_id = businessrole_users.user_id
          where businessrole_skills.businessrole_id = ? and businessrole_users.businessrole_id = ? and businessrole_skills.course_id = ? and enrollments.enrollment_status = 'completed' and enrollments.ExpiryDate < ?",
          [$business_role->id, $business_role->id, $course->course_id, $today]
        );

          $yellow_enrolments["$business_role->id-$course->course_id"] = DB::select("
          select count(distinct enrollments.user_id) as total
          from enrollments
          join businessrole_skills on enrollments.course_id = businessrole_skills.course_id
          join businessrole_users on enrollments.user_id = businessrole_users.user_id
          where businessrole_skills.businessrole_id = ? and businessrole_users.businessrole_id = ? and businessrole_skills.course_id = ? and enrollments.enrollment_status = 'completed' and enrollments.ExpiryDate > ? and enrollments.ExpiryDate < ?",
          [$business_role->id, $business_role->id, $course->course_id, $today, $ninetyDaysLimit]
        );

          $green_enrolments["$business_role->id-$course->course_id"] = DB::select("
          select count(distinct enrollments.user_id) as total
          from enrollments
          join businessrole_skills on enrollments.course_id = businessrole_skills.course_id
          join businessrole_users on enrollments.user_id = businessrole_users.user_id
          where businessrole_skills.businessrole_id = ? and businessrole_users.businessrole_id = ? and businessrole_skills.course_id = ? and enrollments.enrollment_status = 'completed' and enrollments.ExpiryDate > ?",
          [$business_role->id, $business_role->id, $course->course_id, $ninetyDaysLimit]
        );

        $pending_enrolments["$business_role->id-$course->course_id"] = DB::select("
        select count(distinct enrollments.user_id) as total
        from enrollments
        join businessrole_skills on enrollments.course_id = businessrole_skills.course_id
        join businessrole_users on enrollments.user_id = businessrole_users.user_id
        where businessrole_skills.businessrole_id = ? and businessrole_users.businessrole_id = ? and businessrole_skills.course_id = ? and enrollments.enrollment_status = 'pending'",
        [$business_role->id, $business_role->id, $course->course_id]
      );

      $completed_enrolments["$business_role->id-$course->course_id"] = DB::select("
      select count(distinct enrollments.user_id) as total
      from enrollments
      join businessrole_skills on enrollments.course_id = businessrole_skills.course_id
      join businessrole_users on enrollments.user_id = businessrole_users.user_id
      where businessrole_skills.businessrole_id = ? and businessrole_users.businessrole_id = ? and businessrole_skills.course_id = ? and enrollments.enrollment_status = 'completed'",
      [$business_role->id, $business_role->id, $course->course_id]
    );

        }
      }



      foreach($business_roles as $business_role) {
        foreach($courses[$business_role->id] as $course) {
          foreach($green_enrolments["$business_role->id-$course->course_id"] as $green_enrolment) {
            foreach($yellow_enrolments["$business_role->id-$course->course_id"] as $yellow_enrolment) {
              foreach($red_enrolments["$business_role->id-$course->course_id"] as $red_enrolment) {
                foreach($pending_enrolments["$business_role->id-$course->course_id"] as $pending_enrolment) {
                  foreach($completed_enrolments["$business_role->id-$course->course_id"] as $completed_enrolment) {
                    foreach($users[$business_role->id] as $user) {
                      $immediate_total += $course->cost * ($red_enrolment->total + ($user->total - ($pending_enrolment->total + $completed_enrolment->total)));
                      $approaching_total += $course->cost * ($yellow_enrolment->total);
                      $distant_total += $course->cost * ($green_enrolment->total);
                    }
                  }
                }
              }
            }
          }
        }
      }

      //dd($green_enrolments);

      return view('trainingliability.index', compact(
        'business_roles',
        'courses',
        'users',
        'red_enrolments',
        'yellow_enrolments',
        'green_enrolments',
        'pending_enrolments',
        'completed_enrolments',
        'immediate_total',
        'approaching_total',
        'distant_total'
      ));
    }
}
