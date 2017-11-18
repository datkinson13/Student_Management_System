@extends('layouts.master')

@section('content')
<h1>Create business role</h1>
<div class = "row vdivide">
  <div class="col-md-4 pre-scrollable">
    <h4>Users</h4>
    <hr/>
    <ul class = "list-group">
      @foreach($users as $user)
        <li class = "list-group-item draggable">
          <strong>{{ $user->Fname }} {{ $user->Lname }}</strong><br/>
          {{ $user->email }}
        </li>
      @endforeach
    </ul>
  </div>
  <div class="col-md-4">
    <h4>Business role</h4>
    <hr/>
    <form action = "/businessroles" method = "POST">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="subject">Role name:</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Role name...">
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder = "This role..."></textarea>
      </div>
      <label for = "users-droppable">Users:</label>
      <div id = "users-droppable">
        <p>Drop users...</p>
      </div>
      <label for = "courses-droppable">Courses:</label>
      <div id = "courses-droppable">
        <p>Drop courses...</p>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href = "/businessroles"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
    </form>
  </div>
  <div class="col-md-4 pre-scrollable">
    <h4>Courses</h4>
    <hr/>
    <ul class = "list-group">
      @foreach($courses as $course)
        <li class = "list-group-item draggable">
          <strong>{{ $course->name }}</strong><br/>
          {{ $course->subtitle }}
        </li>
      @endforeach
    </ul>
  </div>
</div>
@endsection

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      $(".draggable").draggable();
    });
  </script>
@endsection
