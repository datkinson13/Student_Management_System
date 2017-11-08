@extends('layouts.master')

@section('content')
  <!-- <a  style = "float: right;" href = "/users/{{ $user->id }}/updatePassword"<button class = "btn btn-primary user-profile-buttons">Change Password</button></a> -->
  <a href = "/users/{{ $user->id }}/edit"><button class = "btn btn-primary user-profile-buttons">Edit User</button></a>
  <h1>User: {{ $user->Fname }} {{ $user->Lname }}</h1>
  <p>Email: {{ $user->email}}
  <p>Date of Birth: {{ $user->DOB }}</p>
  <p>Address: {{ $user->address }}</p>
  <p>Phone: {{ $user->phone }}</p>
  <p>Mobile: {{ $user->mobile }}</p>
@endsection
