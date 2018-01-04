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
        @foreach($users[$business_role->id] as $user)
          <tr>
            <td style = "padding-left: 30px;">{{ $course->name }}</td>
            <td>${{ $course->cost * $user->total }}</td>
            <td>$0</td>
            <td>$0</td>
          </tr>
        @endforeach
      @endforeach
    @endforeach
    <tr style = "border-top: 2px solid #000000; border-bottom: 2px solid #000000;">
      <td><strong>Total Expense:</strong></td>
      <td><strong>${{ $immediate_total }}</strong></td>
      <td><strong>$1,000</strong></td>
      <td><strong>$3,000</strong></td>
    </tr>
  </tbody>
</table>
@endsection
