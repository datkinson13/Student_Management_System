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
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Show all business roles -->
      @foreach($businessRoles as $businessRole)
        <tr>
          <td>{{ $businessRole->name }}</td>
          <td>{{ $businessRole->description }}</td>
          <td><a href="#" data-toggle="modal" data-target="#businessrole-users-{{ $businessRole->id }}">{{ $businessRole->users }}</a></td>
          <td><a href = "#" data-toggle="modal" data-target="#businessrole-courses-{{ $businessRole->id }}">{{ $businessRole->courses }}</a></td>
          <td>
            <a href = "/businessroles/{{ $businessRole->id }}"><button class = "btn btn-primary user-action-buttons">Edit</button></a>
            <a href="#">
              <button type="button" class="btn btn-danger user-action-buttons" data-toggle="modal"
                      data-target="#businessrole-delete-modal-{{ $businessRole->id }}">Delete
              </button>
            </a>
          </td>
        </tr>

        <!-- Modal for deleting business role -->
        <!-- https://stackoverflow.com/questions/32469873/show-bootstrap-modal-when-click-on-href-laravel - User: FewFlyBy - 09/09/15 -->
        <div class="modal fade" id="businessrole-delete-modal-{{ $businessRole->id }}" tabindex="-1" role="dialog" aria-labelledby="businessrole-delete-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Delete Business Role: {{ $businessRole->name }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete the Business Role: {{ $businessRole->name }}?
            </div>
            <div class="modal-footer">
              <form method = "POST" action = "/businessroles/{{ $businessRole->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn btn-danger">Delete Business Role</button>
              </form>

              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
        </div>

        <!-- Modal for display all users in business role -->
        <div class="modal fade" id="businessrole-users-{{ $businessRole->id }}" tabindex="-1" role="dialog" aria-labelledby="businessrole-users-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">User list:</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <ul class = "modal-user-list list-group pre-scrollable">
                @foreach($current_users[$businessRole->id] as $user)
                  <li class = "list-group-item">
                    <!-- <form method = "POST" action = "/businessroles/removeuser">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}

                      <input type = "hidden" class = "remove-user" name = "remove-user" value = "{{ $user->id }}">
                      <input type = "hidden" class = "remove-user" name = "remove-user-from-role" value = "{{ $businessRole->id }}">

                      <button type="submit" class="btn btn-danger modal-list-button">Remove user</button>
                    </form>-->

                    <strong>{{ $user->Fname }} {{ $user->Lname }}</strong><br/>
                    {{ $user->email }}
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
        </div>

        <!-- Modal for display all courses in business role -->
        <div class="modal fade" id="businessrole-courses-{{ $businessRole->id }}" tabindex="-1" role="dialog" aria-labelledby="businessrole-courses-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel3">Course list:</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <ul class = "modal-course-list list-group pre-scrollable">
                @foreach($current_courses[$businessRole->id] as $course)
                  <li class = "list-group-item">
                    <!-- <form method = "POST" action = "/businessroles/removecourse">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}


                      <button type="submit" class="btn btn-danger modal-list-button">Remove course</button>
                    </form> -->

                    <strong>{{ $course->name }}</strong>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="modal-footer">
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
