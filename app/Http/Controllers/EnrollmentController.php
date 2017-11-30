<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enrollments = Enrollment::all();
        return view('enrollment.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add some validation

        // What type of user are you?
        if (\Auth::user()->isEmployer()) {
            // Add an additional validator here.

            // If you are an employer you must enroll an employee.
            $enrollUser = $request->input('user_id');
        } else {
            // If you are just a user, you can only enroll yourself.
            $enrollUser = \Auth::id();
        }
        Enrollment::create(['course_id' => $request->input('course_id'), 'user_id' => $enrollUser]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $completed = $request->input('CompletedDate');
        if ($completed) {
            $expiry = date('Y-m-d', strtotime($completed . ' + ' . $enrollment->course->days_valid . ' days'));
        } else {
            $expiry = null;
        }

        Enrollment::where('id', $enrollment->id)
            ->update([
                'enrolment_status' => $request->input('enrolment_status'),
                'CompletedDate' => $request->input('CompletedDate'),
                'ExpiryDate' => $expiry,
            ]);

        return redirect()->route('enrollment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect('/');
    }

    public function withdraw(Request $request)
    {
        // Get enrollment_id from submission and pass to destroy command.
        $this->destroy(Enrollment::find($request->input('enrollment_id')));
        return redirect()->back();
    }
}
