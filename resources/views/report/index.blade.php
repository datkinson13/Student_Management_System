@extends('layouts.master')

@section('content')
<div class="dropdown">
<a href = "/reports/create"><button class = "btn btn-primary user-profile-buttons">Create a report</button></a>
<h1>My Reports</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Report Name</th>
        <th>Entity</th>
        <th>Created date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Display list of all reports -->
      @foreach($reports as $report)
      <tr>
        <td>{{ $report->report_name }}</td>
        <td>{{ $report->report_entity }}</td>
        <td>{{ $report->created_at }}</td>
        <td><a href = "/reports/{{ $report->id }}"><button class = "btn btn-primary user-action-buttons">View Details</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
