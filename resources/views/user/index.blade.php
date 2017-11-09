@extends('layouts.master')

@section('content')
  <a href = "/users/create"><button class = "btn btn-primary user-profile-buttons">Add User</button></a>
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
            <td>
              <a href = "/users/{{ $user->id }}"><button class = "btn btn-primary user-action-buttons">View Details</button></a>
              <a href = "#"><button type = "button" class = "btn btn-danger user-action-buttons" data-toggle="modal" data-target="#user-delete-modal-{{ $user->id }}">Delete User</button></a>
            </td>
          </tr>

          <!-- https://stackoverflow.com/questions/32469873/show-bootstrap-modal-when-click-on-href-laravel - User: FewFlyBy - 09/09/15 -->

          <div class="modal fade" id="user-delete-modal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="user-delete-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
<h4 class="modal-title" id="myModalLabel">Delete User: {{ $user->Fname }} {{ $user->Lname }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete the user {{ $user->Fname }} {{ $user->Lname }}?
              </div>
              <div class="modal-footer">
                <form method = "POST" action = "/users/{{ $user->id }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger">Delete User</button>
                </form>

                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        @endforeach
      </tbody>
    </table>
  </div>
@endsection
