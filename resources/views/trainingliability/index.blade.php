@extends('layouts.master')

@section('content')
<button class = "btn btn-primary" style = "float: right; margin-left: 20px;" type = "button">Email Accounts</button>
<div class="dropdown" style = "float:right;">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Export
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">as Excel</a>
    <a class="dropdown-item" href="#">as Word</a>
    <a class="dropdown-item" href="#">as PDF</a>
  </div>
</div>
<h1>Net Training Liability</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Training Expense</th>
      <th>Immediate</th>
      <th>Approaching</th>
      <th>Distant</th>
    </tr>
  </thead>
  <tbody>
    @foreach($business_roles as $business_role)
      <tr>
        <td><strong>{{ $business_role->name }}</strong></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      @foreach($courses[$business_role->id] as $course)
        @foreach($green_enrolments["$business_role->id-$course->course_id"] as $green_enrolment)
          @foreach($yellow_enrolments["$business_role->id-$course->course_id"] as $yellow_enrolment)
            @foreach($red_enrolments["$business_role->id-$course->course_id"] as $red_enrolment)
              @foreach($pending_enrolments["$business_role->id-$course->course_id"] as $pending_enrolment)
                @foreach($completed_enrolments["$business_role->id-$course->course_id"] as $completed_enrolment)
                  @foreach($users[$business_role->id] as $user)
                    <tr>
                      <td style = "padding-left: 30px;">{{ $course->name }}</td>
                      <td>${{ $course->cost * ($red_enrolment->total + ($user->total - ($pending_enrolment->total + $completed_enrolment->total))) }}</td>
                      <td>${{ $course->cost * ($yellow_enrolment->total )}}</td>
                      <td>${{ $course->cost * ($green_enrolment->total )}}</td>
                    </tr>
                  @endforeach
                @endforeach
              @endforeach
            @endforeach
          @endforeach
        @endforeach
      @endforeach
    @endforeach
    <tr style = "border-top: 2px solid #000000; border-bottom: 2px solid #000000;">
      <td><strong>Total Expense:</strong></td>
      <td><strong>${{ $immediate_total }}</strong></td>
      <td><strong>${{ $approaching_total }}</strong></td>
      <td><strong>${{ $distant_total }}</strong></td>
    </tr>
  </tbody>
</table>
@endsection
