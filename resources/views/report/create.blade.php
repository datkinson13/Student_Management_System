@extends('layouts.master')

@section('content')
<h1>Create a report</h1>

<!-- Report on a specific entity, but use all system entities for available filters -->
<form action = "/users" method = "POST">
  {{ csrf_field() }}

  <div class = "row" style = "padding-left: 20px; padding-bottom: 30px;">
    <h4>Report Name:&nbsp;&nbsp;&nbsp;</h4>
    <input type = "text" class = "form-control col-md-4" id = "report_name" name = "report_name">
  </div>

  <div class = "card" style = "width: 250px;">
    <div class = "card-body">
      <h4 class = "card-title">User</h4>
      <div style = "padding-left: 15px;">
        <div class = "row">
          <label for = "Fname" class = "">
            <input type = "checkbox" class = "" id = "Fname" name = "Fname">
            First Name
          </label>
        </div>
        <div class = "row">
          <label for = "Lname" class = "">
            <input type = "checkbox" class = "" id = "Lname" name = "Lname">
            Last Name
          </label>
        </div>
        <div class = "row">
          <label for = "email" class = "">
            <input type = "checkbox" class = "" id = "email" name = "email">
            Email
          </label>
        </div>
        <div class = "row">
          <label for = "DOB" class = "">
            <input type = "checkbox" class = "" id = "DOB" name = "DOB">
            Date of Birth
          </label>
        </div>
        <div class = "row">
          <label for = "address" class = "">
            <input type = "checkbox" class = "" id = "address" name = "address">
            Address
          </label>
        </div>
        <div class = "row">
          <label for = "phone" class = "">
            <input type = "checkbox" class = "" id = "phone" name = "phone">
            Phone
          </label>
        </div>
        <div class = "row">
          <label for = "mobile" class = "">
            <input type = "checkbox" class = "" id = "mobile" name = "mobile">
            Mobile
          </label>
        </div>
      </div>
    </div>
  </div>

  <div style = "padding-top: 50px;">
    <button class="btn btn-primary user-edit-buttons" type="submit">Save Report</button>
    <a href = "/reports"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
  </div>
</form>



@endsection
