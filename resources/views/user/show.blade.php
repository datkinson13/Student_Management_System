@extends('layouts.master')

@section('content')
  <h1>User: {{ $user->Fname }} {{ $user->Lname }}</h1>
  <p>Date of Birth: {{ $user->DOB }}</p>
  <p>Address: {{ $user->address }}</p>
  <p>Phone: {{ $user->phone }}</p>
  <p>Mobile: {{ $user->mobile }}</p>

@endsection
