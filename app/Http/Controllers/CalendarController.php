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
        // We will start with MyEnrollments. Populate that and then increase events.
        $events = collect([]); // Empty collection to store events.
        if ($request->myEnrollments) {
            if ($currentUser = \Auth::user()) {
                $enrollments = $currentUser->competencies;
                foreach ($enrollments as $enrollment) {
                    if ($request->enrollmentColor !== null) {
                        $enrollment->course->color = $request->enrollmentColor;
                    }
                    $events->push($enrollment->course);
                }
            }
        }
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
