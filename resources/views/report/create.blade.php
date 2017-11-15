@extends('layouts.master')

@section('content')
<h1>Create a report</h1>
<form>
{{ csrf_field() }}

<div class = "form-group row">
  <label for = "report_name" class = "col-sm-2 col-form-label">Report Name: </label>
  <input type="text" class="col-sm-4 form-control" id="report_name" name="report_name" aria-describedby="report_name" placeholder="Report name...">
</div>

<div class = "form-group row">
  <label for ="report_entity" class = "col-sm-2 col-form-label">Report Entity: </label>
  <select class = "col-sm-4 form-control">
    <option value = "user">User</option>
    <option value = "enrolment">Enrolment</option>
    <option value = "course">Course</option>
    <option value = "ticket">Ticket</option>
  </select>
</div>

<div class = "form-group row">
  <label for ="chart_type" class = "col-sm-2 col-form-label">Chart type: </label>
  <select class = "col-sm-4 form-control">
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
    <option value = "account">User Accounts</option>
    <option value = "geographic">Geographic</option>
    <option value = "demographic">Demographic</option>
  </select>
  <select id = "account" class = "col-sm-4 form-control" style = "margin-left: 30px;">
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
  <!--<div class = "col-sm-1" style = "padding-top: 3px;">
    <i id = "add_data" class = "fa fa-plus-circle fa-2x"></i>
  </div>-->
</div>


<div id = "filters_row" class = "form-group row">
  <label for ="selected_filters" class = "col-sm-2 col-form-label">Additional filters: </label>
  <select id = "selected_filters" class = "col-sm-2 form-control">
    <option value = "filter_user">User</option>
    <option value = "filter_enrolment">Enrolment</option>
    <option value = "filter_course">Course</option>
    <option value = "filter_ticket">Ticket</option>
  </select>
  <select id = "filter_user_fields" class = "col-sm-2 form-control" style = "margin-left: 30px;">
    <option value = "user_created">Created</option>
    <option value = "user_updated">Updated</option>
  </select>
  <select id = "filter_user_equation" class = "col-sm-1 form-control" style = "margin-left: 30px;">
    <option value = "user_equals"> = </option>
  </select>
  <input  style = "margin-left: 30px;" type="text" class="col-sm-2 form-control" id="filter_user_input" name="filter_user_input" aria-describedby="filter_user_input">
  <!--<div class = "col-sm-1" style = "padding-top: 3px; padding-left: 52px;">
    <i id = "add_data" class = "fa fa-plus-circle fa-2x"></i>
  </div>-->
</div>

<button class="btn btn-primary user-edit-buttons" type="submit">Save Report</button>
<a href = "/reports"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>

</form>
@endsection

@section('footer-scripts')
<script>
$('#selected_data').change(function() {
  var selected_data = $('#selected_data').val();

  if(selected_data === ("account")) {
    $("#account").show();
    $("#geopgraphic").hide();
    $("#demographic").hide();
  } else if (selected_data === ("geographic")) {
    $("#geographic").show();
    $("#account").hide();
    $("#demographic").hide();
  } else if (selected_data === ("demographic")) {
    $("#demographic").show();
    $("#account").hide();
    $("#geographic").hide();
  }
});
</script>
@endsection
