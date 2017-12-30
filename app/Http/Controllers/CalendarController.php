<?php

namespace App\Http\Controllers;

use App\Enrollment;
use App\Http\Resources\CalendarEventsCollection;
use App\Http\Resources\CalendarEvents;
use Carbon\Carbon;
use App\Course;
use Illuminate\Http\Request;

//use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class CalendarController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calDefault = [];

        $calendarSettings = $request->session()->get('calSettings', $calDefault);

        return view('calendar.index', compact('calendar'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Return a JSON list of events.
     *
     * @return \App\Http\Resources\CalendarEventsCollection
     */
    public function events(Request $request)
    {
        // Get some events to show and filter here.
        $events = collect([]); // Empty collection to store events.

        // We will start with MyEnrollments. Populate that and then increase events.

            if ($currentUser = \Auth::user()) {
                $enrollments = $currentUser->monitoredCompetencies(true);
                if ($request->myEnrollments || $request->myCompetencies) {
                    foreach ($enrollments as $enrollment) {
                        // Determine if this enrollment is complete.
                        if ($enrollment->enrollment_status == 'Completed') {
                            // If enrollment is complete then this is a competency.
                            if ($request->myCompetencies) {
                                if ($request->competencyColor !== null) {
                                    $enrollment->color = $request->competencyColor;
                                } else {
                                    $enrollment->color = "#51B749";
                                }
                                $events->push($enrollment);
                            }
                        } elseif ($enrollment->enrollment_status == 'In Progress') {
                            // If enrollment is not complete this is an enrollment.
                            if ($request->myEnrollments) {
                                if ($request->enrollmentColor !== null) {
                                    $enrollment->course->color = $request->enrollmentColor;
                                }
                                $events->push($enrollment->course);
                            }
                        } elseif ($enrollment->enrollment_status == 'failed') {
                            // This course was failed. What should we do with it?
                        } elseif ($enrollment->enrollment_status == 'pending') {
                            // This course is pending. What should we do with it?
                            if ($request->myEnrollments) {
                                if ($request->enrollmentColor !== null) {
                                    $enrollment->course->color = $request->enrollmentColor;
                                }
                                $events->push($enrollment->course);
                            }
                        }
                    }
                }
            }

        // Add myFacilitated courses
        if ($request->iFacilitate) {
            if ($currentUser = \Auth::user()) {
                // You can only get these if you're logged in. Need a user id.
                $events = $events->merge(
                    Course::where('user_id', '=', $currentUser->id)->get()->each(function($course) use ($request) {
                        if ($request->facilitateColor !== null) {
                            $course = $course->color = $request->facilitateColor;
                        }
                        return $course;
                    })
                );
            }
        }

        // Add the rest of the courses.
        if ($request->allCourses) {
            $events = $events->merge(Course::all()->each(function($course) use ($request) {
                if ($request->courseColor !== null) {
                    $course = $course->color = $request->courseColor;
                }
                return $course;
            })); // Return a collection of all Course events.
        }

        // We've now collected all events that the user has requested.
        // We need to filter them based on the parameters (reducing the number of events returned)
        // This will allow a much larger number of events yet still keep the frontend fast.
        if ($request->start && $request->end) {
            // Only filter if we have some params.
            $calEvents = $events->filter(function ($course, $index) use ($request) {

                /* Things that must work:
                 * 1. Start date is before period, end date is within.
                 * 2. Start date is within period, end date is within.
                 * 3. Start date is before period, end date is after period.
                 * 4. Start date is within period, end date is after period.
                 *
                 * Logic:
                 * if eventEnd is after start && eventStart is before end.
                 *
                 * */

                $start = new Carbon($course->StartDate); // Convert the course StartDate into a carbon date.
                $end = new Carbon($course->EndDate);     // Convert the course EndDate into a carbon date.

                $startBool = $start->lte(new Carbon($request->end));
                $endBool = $end->gte(new Carbon($request->start));

                return ($startBool && $endBool); // If both are true return true, else return false.
            });
        }

        // Populate a custom collection.
        $calendarEventCol = new CalendarEventsCollection($calEvents);

        return $calendarEventCol;
    }
}
