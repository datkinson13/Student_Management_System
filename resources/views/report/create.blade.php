@extends('layouts.master')

@section('content')
<h1>Create a report</h1>
<form method = "POST" action = "/reports">
{{ csrf_field() }}

<div class = "form-group row">
  <label for = "report_name" class = "col-sm-2 col-form-label">Report Name: </label>
  <input type="text" class="col-sm-4 form-control" id="report_name" name="report_name" aria-describedby="report_name" placeholder="Report name...">
</div>

<div class = "form-group row">
  <label for ="report_entity" class = "col-sm-2 col-form-label">Report Entity: </label>
  <select class = "col-sm-4 form-control" id = "report_entity" name = "report_entity">
    <option value = "users">Users</option>
    <option value = "enrolments">Enrolments</option>
    <option value = "courses">Courses</option>
    <option value = "tickets">Tickets</option>
    <option value = "business_roles">Business Roles</option>
  </select>
</div>

<div class = "form-group row">
  <label for ="chart_type" class = "col-sm-2 col-form-label">Chart type: </label>
  <select class = "col-sm-4 form-control" id = "chart_type" name = "chart_type">
    <option value = "line">Line chart</option>
    <option value = "bar">Bar chart</option>
    <option value = "radar">Radar chart</option>
    <option value = "radar">Radar chart</option>
    <option value = "pie">Pie chart</option>
    <option value = "doughnut">Doughnut chart</option>
    <option value = "polarArea">Polar Area chart</option>
  </select>
</div>

<br/><br/>
<button class="btn btn-primary user-edit-buttons" type="submit">Save Report</button>
<a href = "/reports"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>

</form>
@endsection
