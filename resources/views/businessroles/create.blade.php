@extends('layouts.master')

@section('content')
<h1>Create business role</h1>
<div id = "dragzone col-md-12">
  <div class = "row vdivide">
    <div id = "users" class="col-md-4 pre-scrollable">
      <h4>Users</h4>
      <hr/>
      <ul class = "list-group">
        @foreach($users as $user)
          <li class = "list-group-item user-draggable">
            <span class = "user-id" style = "display: none;">{{ $user->id }}</span>
            <strong><span class = "user-name">{{ $user->Fname }} {{ $user->Lname }}</span></strong><br/>
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
        <label for = "user-droppable">Users:</label>
        <div id = "user-droppable">
        </div>
        <label for = "course-droppable">Courses:</label>
        <div id = "course-droppable">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href = "/businessroles"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
      </form>
    </div>
    <div id = "courses" class="col-md-4 pre-scrollable">
      <h4>Courses</h4>
      <hr/>
      <ul class = "list-group">
        @foreach($courses as $course)
          <li class = "list-group-item course-draggable">
            <strong>{{ $course->name }}</strong><br/>
            {{ $course->subtitle }}
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      $('.user-draggable').draggable({
        containment: "#dragzone",
        scroll: false,
        appendTo: 'body',
        cursor: 'move',
        revert: true,
        helper: 'clone',
      });
      $('#user-droppable').droppable({
        accept: '.user-draggable',
        drop: function(event, item) {
          $(this).append('<div class = "role-user"><span class = "role-user-id">'
           + $(item.draggable).find('.user-id').text() + "</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;"
           + '<span class = "role-user-name">' + $(item.draggable).find('.user-name').text()
           + '<span style = "float:right;" class = "role-user-delete">'
           + '<i class="fa fa-minus-circle" aria-hidden="true"></i></span></div><br/>');
        }
      });

      $('.course-draggable').draggable({
        containment: "#dragzone",
        scroll: false,
        appendTo: 'body',
        cursor: 'move',
        revert: true,
        helper: 'clone'
      });
      $('#course-droppable').droppable({
        accept: '.course-draggable',
        drop: function(event, ui) {
          $(this).append($(ui.draggable).clone());
        }
      });
    });
  </script>
@endsection
