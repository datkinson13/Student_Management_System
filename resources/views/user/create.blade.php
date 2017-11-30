@extends('layouts.master')

@section('content')
  <h1>New User</h1>
  <form enctype = "multipart/form-data" action = "/users" method = "POST">
    {{ csrf_field() }}

    <div class = "form-group row">
      <label for = "Fname" class = "col-sm-2 col-form-label">First Name:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "Fname" name = "Fname">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "Lname" class = "col-sm-2 col-form-label">Last Name:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "Lname" name = "Lname">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "email" class = "col-sm-2 col-form-label">Email:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "email" name = "email">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "avatar" class = "col-sm-2 col-form-label">Profile Picture:</label>
      <div class = "col-sm-6">
        <input type = "file" id = "avatar" name = "avatar" accept = "image/*">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "DOB" class = "col-sm-2 col-form-label">Date of Birth:</label>
      <div class = "col-sm-6">
        <!-- Need to change date formate to DD/MM/YYYY -->
        <input type = "text" class = "form-control" id = "DOB" name = "DOB">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "address" class = "col-sm-2 col-form-label">Address:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "address" name = "address">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "phone" class = "col-sm-2 col-form-label">Phone:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "phone" name = "phone">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "mobile" class = "col-sm-2 col-form-label">Mobile:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "mobile" name = "mobile">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "identification" class = "col-sm-2 col-form-label">Proof of identification:</label>
      <div class = "col-sm-6">
        <input type = "file" id = "identification" name = "identification" accept = "application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/pdf, image/*">
      </div>
    </div>
    <hr/>
    <div class = "form-group row">
      <label for = "password" class = "col-sm-2 col-form-label">Password:</label>
      <div class = "col-sm-6">
        <input type = "password" class = "form-control" id = "password" name = "password">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "confirmPassword" class = "col-sm-2 col-form-label">Confirm Password:</label>
      <div class = "col-sm-6">
        <input type = "password" class = "form-control" id = "confirmPassword" name = "confirmPassword">
      </div>
    </div>
    <button class="btn btn-primary user-edit-buttons" type="submit">Save User</button>
    <a href = "/users"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
  </form>
@endsection
