@extends('layouts.master')

@section('content')
<h1>My Enrollments</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Course</th>
        <th>Date Completed</th>
        <th>Status</th>
        <th>Expiry Date</th>
        <th>Days remaining</th>
        <th>Calculated level</th>
      </tr>
    </thead>
    <tbody>
      @foreach($enrollments as $enrollment)
        <tr>
          <td>{{ $enrollment->id }}</td>
          <td>{{ $enrollment->course->name }}</td>
          <td>{{ $enrollment->CompletedDate }}</td>
          <td>{{ $enrollment->enrolment_status }}</td>
          <td>{{ $enrollment->ExpiryDate }}</td>
          <td>{{ $enrollment->daysRemaining() }}</td>
          <td>{{ $enrollment->competencyStatus()['color'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
