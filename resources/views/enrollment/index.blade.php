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
          <td>{{ $enrollment->course_id }}</td>
          <td>{{ $enrollment->CompletedDate }}</td>
          <td>{{ $enrollment->enrolment_status }}</td>
          <td>{{ $enrollment->ExpiryDate }}</td>
          <td>
            @php
              $date1 = new DateTime($enrollment->ExpiryDate);
              $now = new DateTime('now');
              $interval = $date1->diff($now);
              $days = $interval->format('%a')
            @endphp
            {{ $days }}
          </td>
          <td>
            @php
              if ($days < 30) {
                $level = "RED";
              } elseif ($days < 90) {
                $level = "YELLOW";
              } else {
                $level = "GREEN";
              }
            @endphp
            {{ $level }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
