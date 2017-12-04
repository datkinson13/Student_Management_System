<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Course;
use Illuminate\Http\Request;

//use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        $events = []; // Create array to hold events.

        foreach ($courses as $course) {
            $StartDate = new Carbon($course->StartDate);
            $EndDate = new Carbon($course->EndDate);

            // Build some events.
            $events[] = \Calendar::event(
                $course->name, //event title
                false, //full day event?,
                $StartDate,
                $EndDate,
                $course->id,
                [
                    'color' => ''
                ]
            );
        }

        $calendar = \Calendar::addEvents($events)
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1
            ]);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
