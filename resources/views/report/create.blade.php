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
    <option value = "user">User</option>
    <option value = "enrolment">Enrolment</option>
    <option value = "course">Course</option>
    <option value = "ticket">Ticket</option>
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
    <option value = "bubble">Bubble chart</option>
  </select>
</div>

<div id = "data_row" class = "form-group row">
  <label for ="selected_data" class = "col-sm-2 col-form-label">Selected data: </label>
  <select id = "selected_data" class = "col-sm-4 form-control">
    <option value = "created">Created</option>
    <option value = "geographic">Geographic</option>
    <option value = "demographic">Demographic</option>
  </select>
  <select id = "created" class = "col-sm-4 form-control" style = "margin-left: 30px;">
    <option value = "monthly">Monthly</option>
    <option value = "yearly">Yearly</option>
  </select>
  <select id = "geographic" class = "col-sm-4 form-control" style = "margin-left: 30px; display: none;">
    <option value = "suburb">Suburb</option>
    <option value = "state">State</option>
    <option value = "country">Country</option>
  </select>
  <select id = "demographic" class = "col-sm-4 form-control" style = "margin-left: 30px; display: none;">
    <option value = "ageGroup">Age Group</option>
    <option value = "gender">Gender</option>
  </select>
</div>
<br/><br/>
<button class="btn btn-primary user-edit-buttons" type="submit">Save Report</button>
<a href = "/reports"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>

</form>
@endsection

@section('footer-scripts')
<script>
$('#selected_data').change(function() {
  var selected_data = $('#selected_data').val();

  if(selected_data === ("created")) {
    $("#created").show();
    $("#geographic").hide();
    $("#demographic").hide();
  } else if (selected_data === ("geographic")) {
    $("#geographic").show();
    $("#created").hide();
    $("#demographic").hide();
  } else if (selected_data === ("demographic")) {
    $("#demographic").show();
    $("#created").hide();
    $("#geographic").hide();
  }
});
</script>
@endsection
