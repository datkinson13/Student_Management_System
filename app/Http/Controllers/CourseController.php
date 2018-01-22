<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\StoreCourse;
use Illuminate\Http\Request;

class CourseController extends Controller {

    public function __construct()
    {
        //$this->middleware('auth');
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

        $courses = Course::all()->filter(function ($course) {
            if ($course->trashed()) {
                return false;
            }
            return $course->visible();
        })->all();

        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Course::class);

        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCourse $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {
        // The incoming request is valid and authorized...
        //      because the StoreCourse class handles all validation and authorization.

        // This line is redundant, the request cannot get to this point if it isn't authorized.
        // Will leave it here as not all requests are using Request validators so it will look out of place without it.
        $this->authorize('create', Course::class);

        $course = Course::create([
            'name'        => $request->input('name'),
            'subtitle'    => $request->input('subtitle'),
            'description' => $request->input('description'),
            'StartDate'   => $request->input('StartDate'),
            'EndDate'     => $request->input('EndDate'),
            'CourseTime'  => $request->input('CourseTime'),
            'days_valid'  => $request->input('days_valid'),
            'user_id'     => \Auth::user()->id,
            'cost'        => $request->input('cost')
        ]);

        if (\Auth::user()->can('assignFacilitator', Course::class)) {
            $course->user_id = $request->input('user_id');
            $course->save();
        }

        return redirect(route('course.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if (!$course->visible()) {
            abort(404);
        }

        // Really unhappy about disabling this line.
        // Maybe there is a way to keep it.
        // Currently it would seem that an unauthed user is by default not authorized for any tasks.
        // $this->authorize('view', $course);


        // Create two arrays that hold all managed users for the current user.
        $enrolledUsers = []; // This will hold all enrolled users.
        $nonEnrolledUsers = []; // This will hold all non enrolled users.

        if (\Auth::user()) {
            // Get the current authed user.
            $currentUser = \Auth::user();
            // What type of user is this?
            if ($currentUser->isEmployer()) {
                // This user is an employer. Return their employees.
                foreach ($currentUser->employer->employees as $employee) {
                    if ($enrollment = $employee->user->competencies->where('course_id', $course->id)->first()) {
                        array_push($enrolledUsers, $enrollment);
                    } else {
                        array_push($nonEnrolledUsers, $employee);
                    }
                }
            } elseif ($currentUser->hasAccess(['users-edit-enrollment'])) {
                // This user is an Administrator. Return all users.
                // $enrollments = $course->enrollments; // Get all enrollments
            } else {
                $enrollment = $course->enrollments->where('user_id', $currentUser->id)->first();
                if (count($enrollment) > 0) {
                    $enrolledUsers = $enrollment;
                } else {
                    $nonEnrolledUsers = $currentUser;
                }
            }
        }

        return view('course.show', compact('course', 'enrolledUsers', 'nonEnrolledUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);
        // do the updating.
        $course->update([
            'name'        => $request->input('name'),
            'subtitle'    => $request->input('subtitle'),
            'description' => $request->input('description'),
            'StartDate'   => $request->input('StartDate'),
            'EndDate'     => $request->input('EndDate'),
            'CourseTime'  => $request->input('CourseTime'),
            'days_valid'  => $request->input('days_valid'),
            'user_id'     => \Auth::user()->id,
            'cost'        => $request->input('cost')
        ]);

        if (\Auth::user()->can('assignFacilitator', Course::class)) {
            $course->user_id = $request->input('user_id');
            $course->save();
        }

        return redirect(route('course.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
        return redirect(route('course.index'));
    }

    /**
     * Allows sending of an email to all students enrolled in the course..
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function compose(Course $course)
    {
        $this->authorize('compose', $course);

        return view('course.email', compact('course'));
    }
}
