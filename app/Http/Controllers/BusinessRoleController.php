<?php

namespace App\Http\Controllers;

use App\BusinessRole;
use App\User;
use App\Course;
use App\Enrollment;
use DB;
use Illuminate\Http\Request;

class BusinessRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_roles = BusinessRole::all();

        foreach($business_roles as $business_role) {
          $business_role->users = sizeof(explode(",", $business_role->users)) - 1;
          $business_role->courses = sizeof(explode(",", $business_role->courses)) - 1;
        }

        return view('businessroles.index', compact('business_roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
      BusinessRole::create([
              'name' => $request->input('name'),
              'description' => $request->input('description'),
              'users' => $request->input('request-users'),
              'courses' => $request->input('request-courses')
            ]);

        return redirect('/businessroles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessRole  $businessRole
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessRole $businessRole)
    {
      $users = User::orderBy('Lname', 'asc')->get();
      $courses = Course::orderBy('name', 'asc')->get()->unique('name');

      dd($businessRole);

      return view('businessroles.show', compact('businessRole', 'users', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessRole  $businessRole
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessRole $businessRole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessRole  $businessRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessRole $businessRole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessRole  $businessRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessRole $businessRole)
    {
        //
    }
}
