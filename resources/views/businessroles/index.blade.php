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
      @foreach($businessRoles as $businessRole)
        <tr>
          <td>{{ $businessRole->name }}</td>
          <td>{{ $businessRole->description }}</td>
          <td>{{ $businessRole->users }}</td>
          <td>{{ $businessRole->courses }}</td>
          <td>
            <a href = "/businessroles/{{ $businessRole->id }}"><button class = "btn btn-primary user-action-buttons">Edit</button></a>
            <a href="#">
              <button type="button" class="btn btn-danger user-action-buttons" data-toggle="modal"
                      data-target="#businessrole-delete-modal-{{ $businessRole->id }}">Delete
              </button>
            </a>
          </td>
        </tr>

        <!-- https://stackoverflow.com/questions/32469873/show-bootstrap-modal-when-click-on-href-laravel - User: FewFlyBy - 09/09/15 -->

        <div class="modal fade" id="businessrole-delete-modal-{{ $businessRole->id }}" tabindex="-1" role="dialog" aria-labelledby="businessrole-delete-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Delete Business Role: {{ $businessRole->name }}</h4>
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

      @endforeach
    </tbody>
  </table>
</div>
@endsection
