@extends('layouts.master')

@section('content')
<div class="dropdown">
<a href = "/businessroles/create"><button class = "btn btn-primary user-profile-buttons">Create business role</button></a>
<h1>My Business Roles</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Users</th>
        <th>Courses</th>
      </tr>
    </thead>
    <tbody>
      @foreach($business_roles as $business_role)
        <tr>
          <td>{{ $business_role->name }}</td>
          <td>{{ $business_role->description }}</td>
          <td>{{ $business_role->users }}</td>
          <td>{{ $business_role->courses }}</td>
          <td>
            <td>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
