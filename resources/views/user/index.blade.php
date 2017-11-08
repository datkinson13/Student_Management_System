@extends('layouts.master')

@section('content')
  <h1>Users</h1>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Date of Birth</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->Fname }}</td>
            <td>{{ $user->Lname }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->email }}</td>
            <td><a href = "/users/{{ $user->id }}"><button class = "btn btn-primary">Edit User</button></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
