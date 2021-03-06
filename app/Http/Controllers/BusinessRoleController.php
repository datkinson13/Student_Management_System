<?php

namespace App\Http\Controllers;

use App\BusinessRole;
use App\User;
use App\Course;
use App\Enrollment;
use App\Mail\BusinessRoleChanged;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BusinessRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($currentUser = \Auth::user()) {
            if ($currentUser->can('view', BusinessRole::class)) {

                // Grab all business roles
                $businessRoles = BusinessRole::all();

                $current_users = [];
                $current_courses = [];

                // Set the number of users/courses in each business role and determine which users/courses are relevant
                foreach($businessRoles as $businessRole) {
                    $businessRole->users = sizeof(explode(",", $businessRole->users)) - 1;
                    $businessRole->courses = sizeof(explode(",", $businessRole->courses)) - 1;

                    $current_users[$businessRole->id] = DB::select('select * from businessrole_users inner join users on businessrole_users.user_id = users.id where businessrole_users.businessrole_id = ?', [$businessRole->id]);
                    $current_courses[$businessRole->id] = DB::select('select * from businessrole_skills inner join courses on businessrole_skills.course_id = courses.id where businessrole_skills.businessrole_id = ?', [$businessRole->id]);
                }

                return view('businessroles.index', compact('businessRoles', 'current_users', 'current_courses'));
            } else {
                dd('Something about creating a business account to access this section.');
            }
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Pass through list of available users/courses for business role
        $users = User::orderBy('Lname', 'asc')->get();
        $courses = Course::orderBy('name', 'asc')->get()->unique('name');

        return view('businessroles.create', compact('users', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Save new business role to database
      $businessRole = BusinessRole::create([
              'name' => $request->input('name'),
              'description' => $request->input('description'),
              'users' => $request->input('request-users'),
              'courses' => $request->input('request-courses')
            ]);

      $businessRole->save();

      // Save record of users/courses added to role into array
      $added_users = explode(',', $request->input('request-users'));
      $added_skills = explode(',', $request->input('request-courses'));

      // Save record of users to database
      foreach($added_users as $user) {
        if($user != '') {
          DB::insert('insert into businessrole_users (user_id, businessrole_id) values (?, ?)', [$user, $businessRole->id]);
          Mail::to(DB::select('select email from users where id = ?', [$user]))->send(new BusinessRoleChanged());
        }
      }

      // Save record of courses to database
      foreach($added_skills as $skill) {
        if($skill != '') {
          DB::insert('insert into businessrole_skills (course_id, businessrole_id) values (?, ?)', [$skill, $businessRole->id]);
        }
      }

      return redirect('/businessroles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessRole  $businessrole
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessRole $businessrole)
    {
      $businessRole = $businessrole;

      // Show all other users and courses so that they can be added to role
      $users = User::orderBy('Lname', 'asc')->get();
      $courses = Course::orderBy('name', 'asc')->get()->unique('name');

      // Show all users and courses in the business role
      $current_users = DB::select('select * from businessrole_users inner join users on businessrole_users.user_id = users.id where businessrole_users.businessrole_id = ?', [$businessrole->id]);
      $current_courses =  DB::select('select * from businessrole_skills inner join courses on businessrole_skills.course_id = courses.id where businessrole_skills.businessrole_id = ?', [$businessrole->id]);

      return view('businessroles.show', compact('businessRole', 'users', 'courses', 'current_users', 'current_courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessRole  $businessrole
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessRole $businessrole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessRole  $businessrole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessRole $businessrole)
    {
        BusinessRole::where('id', $businessrole->id)
                    ->update([
                      'name' => $request->input('name'),
                      'description' => $request->input('description'),
                      'users' => $request->input('request-users'),
                      'courses' => $request->input('request-courses')
                    ]);

        // Delete existing role records for users/courses
        DB::table('businessrole_users')->where('businessrole_id', '=', $businessrole->id)->delete();
        DB::table('businessrole_skills')->where('businessrole_id', '=', $businessrole->id)->delete();

        // Save new users/courses to array
        $updated_users = explode(',', $request->input('request-users'));
        $updated_skills = explode(',', $request->input('request-courses'));

        // Update users/skills for business role in the database
        foreach($updated_users as $user) {
          if($user != '') {
            DB::insert('insert into businessrole_users (user_id, businessrole_id) values (?, ?)', [$user, $businessrole->id]);
            Mail::to(DB::select('select email from users where id = ?', [$user]))->send(new BusinessRoleChanged());
          }
        }

        foreach($updated_skills as $skill) {
          if($skill != '') {
            DB::insert('insert into businessrole_skills (course_id, businessrole_id) values (?, ?)', [$skill, $businessrole->id]);
          }
        }

        return redirect('/businessroles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessRole  $businessrole
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessRole $businessrole)
    {
        $businessrole->delete();

        return redirect('/businessroles');
    }

    /*
    public function removeUser (Request $request)
    {
      $user = $request->input('remove-user');
      $businessRole = $request->input('remove-user-from-role');

      DB::delete('delete from businessrole_users where user_id = ? AND businessrole_id = ?', [$user, $businessRole]);

    }

    public function removeCourse (Request $request)
    {

    }
    */
}
