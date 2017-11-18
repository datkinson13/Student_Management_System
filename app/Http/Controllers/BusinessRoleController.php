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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessRole  $businessRole
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessRole $businessRole)
    {
        //
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
