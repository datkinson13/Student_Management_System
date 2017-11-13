@extends('layouts.master')

@section('content')
<a href = "#"><button class = "btn btn-primary user-profile-buttons">Create report</button></a>
<h1>My Reports</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Created date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>

@endsection
