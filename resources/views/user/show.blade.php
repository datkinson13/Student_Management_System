@extends('layouts.master')

@section('content')
  <h1>User: {{ $user->FName }} {{ $user->LName }}</h1>
  <p>Date of Birth: {{ $user->DOB }}</p>
  <p>Address: {{ $user->Address }}</p>
  <p>Phone: {{ $user->Phone }}</p>
  <p>Mobile: {{ $user->Mobile }}</p>

@endsection
