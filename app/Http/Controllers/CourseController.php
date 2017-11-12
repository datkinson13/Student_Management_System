<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display all courses. Allowing user to select which course they would like to view.
        //   After selecting the course a Student would then be able to enroll.
        //   After selecting the course a Coordinator would then be able to edit.
        //   Pagination should not be apart of this version, maybe considered for v2.

        $courses = Course::all(); // Uncomment when we have a DB and some courses.
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Do some validation first.

        Course::create([
            'name' => $request->input('name'),
            'subtitle' => $request->input('subtitle'),
            'description' => $request->input('description'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'CourseTime' => $request->input('CourseTime'),
            'user_id' => \Auth::user()->id,
        ]);

        return redirect(route('course.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course) // This should be changed to reflect the doco above. Course $course.
    {
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Allows sending of an email to all students enrolled in the course..
     *
     * @param  Course  $course
     * @return \Illuminate\Http\Response
     */
    public function compose($course)
    {
        return view('course.email', compact('course'));
    }
}
