<?php

namespace App\Http\Controllers;

use App\Report;
use App\User;
use App\Course;
use App\Enrollment;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!\Auth::user()->can('view', Report::class)) {
            return redirect(route('home'));
        }
        $reports = Report::orderBy('created_at', 'desc')->get();

        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (!\Auth::user()->can('create', Report::class)) {
          return redirect(route('home'));
      }
      return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!\Auth::user()->can('create', Report::class)) {
            return redirect(route('home'));
        }

      Report::create([
              'report_name' => $request->input('report_name'),
              'report_entity' => $request->input('report_entity'),
              'type' => $request->input('chart_type'),
              'label' => '',
              'data' => '',
              'options' => ''
            ]);

        return redirect('/reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        if (!\Auth::user()->can('view', Report::class)) {
            return redirect(route('home'));
        }

      // Determine relevant report type and grab data
      $table = $report->report_entity;
      $columns = DB::getSchemaBuilder()->getColumnListing($table);
      $data = DB::select("SELECT * FROM $table");

      // Set labels for report graph to months and grab relevant data
      $labels = '["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"]';
      $frequencies = DB::select("SELECT MONTH(created_at) month, COUNT(*) count FROM $table WHERE YEAR(created_at)=YEAR(CURRENT_TIMESTAMP) GROUP BY month ORDER BY month ASC");

      // Initialise graph column data to 0
      $chart_data = [0,0,0,0,0,0,0,0,0,0,0,0];

      // For each month of the year, display data as calculated
      foreach($frequencies as $frequency) {
        for($i = 1; $i < 13; $i++) {
          if($i == $frequency->month) {
            $chart_data[$i - 1] = $frequency->count;
          }
        }
      }

      return view('report.show', compact('report', 'columns', 'data', 'labels', 'chart_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        if (!\Auth::user()->can('update', Report::class)) {
            return redirect(route('home'));
        }

      Report::where('id', $report->id)
            ->update([
              'report_name' => $request->input('report_name'),
              'report_entity' => $request->input('report_entity'),
              'type' => $request->input('chart_type')
            ]);

            return redirect()->route('reports.show', ['report' => $report]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
