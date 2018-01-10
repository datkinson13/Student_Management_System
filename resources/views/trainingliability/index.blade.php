@extends('layouts.master')

@section('content')
<button class = "btn btn-primary" style = "float: right; margin-left: 20px;" type = "button">Email Accounts</button>
<div class="dropdown" style = "float:right;">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Export
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#" id = "excel_button" onClick="javascript:ExcelReport()">as Excel</a>
    <a class="dropdown-item" href="#" id = "word_button">as Word</a>
    <a class="dropdown-item" href="#" id = "pdf_button">as PDF</a>
  </div>
</div>
<h1>Net Training Liability</h1>
<table class="table table-striped" id = "expense_table">
  <thead>
    <tr>
      <th><span style = "text-decoration: underline;"><em>Training Expense</em></span></th>
      <th><span id = "immediate" title = "Expired or no enrolments">Immediate</span></th>
      <th><span id = "approaching" title = "Enrolment expiring within 90 days">Approaching</span></th>
      <th><span id = "distant" title = "Enrolment expiring sometime after 90 days">Distant</span></th>
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
                      <!--  Why is it not passing into ALL business role courses? Seems to be totalling in one per role? -->
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

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      $('#immediate').tooltip();
      $('#approaching').tooltip();
      $('#distant').tooltip();

      $('#excel_button').on('click', function() {

      });

      $('#word_button').on('click', function() {

      });

      $('#pdf_button').on('click', function() {

      });

    });
  </script>
@endsection
