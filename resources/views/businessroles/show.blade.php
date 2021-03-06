@extends('layouts.master')

@section('content')
<h1>Edit business role</h1>
<div id = "dragzone col-md-12">
  <div class = "row vdivide">
    <div class="col-md-4">
      <h4>Users</h4>
      <hr/>
      <div id = "users" class = "pre-scrollable">
        <ul class = "list-group">
          <!-- Display list of all users not already in role -->
          @foreach($users as $user)
            <li id = "user-{{ $user->id }}" class = "list-group-item user-draggable" data-user-id = "{{ $user->id }}">
              <span class = "user-id" style = "display: none;">{{ $user->id }}</span>
              <strong><span class = "user-name">{{ $user->Fname }} {{ $user->Lname }}</span></strong><br/>
              {{ $user->email }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col-md-4">
      <h4>Business role</h4>
      <hr/>
      <!-- Display create/edit role form -->
      <form action = "/businessroles/{{ $businessRole->id }}" method = "POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
          <label for="subject">Role name:</label>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value = "{{ $businessRole->name }}" placeholder="{{ $businessRole->name }}">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" id="edit-description" name="description" rows="4" placeholder="{{ $businessRole->description }}">{{ $businessRole->description }}</textarea>
        </div>
        <label for = "user-droppable">Users:</label>
        <div id = "user-droppable">
          <!-- Show all users currently in role -->
          @foreach($current_users as $user)
            <div class = "role-user">
              <span style = "display:none;" class = "role-user-id">{{ $user->id }},</span>
              <span class = "role-user-name">{{ $user->Fname }} {{ $user->Lname }}</span>
              <span style = "float:right;">
                <i class="fa fa-minus-circle remove-user" aria-hidden="true"></i>
              </span>
            </div>
          @endforeach
        </div>
        <input type = "hidden" id = "request-users" name = "request-users">
        <label for = "course-droppable">Courses:</label>
        <div id = "course-droppable">
          <!-- Show all courses currently in role -->
          @foreach($current_courses as $course)
            <div class = "role-course">
              <span style = "display: none;" class = "role-course-id">{{ $course->id }},</span>
              <span class = "role-course-name">{{ $course->name }}</span>
              <span style = "float:right;">
                <i class="fa fa-minus-circle remove-course" aria-hidden="true"></i>
              </span>
            </div>
          @endforeach
        </div>
        <input type = "hidden" id = "request-courses" name = "request-courses">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href = "/businessroles"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
      </form>
    </div>
    <div class="col-md-4">
      <h4>Courses</h4>
      <hr/>
      <div id = "courses" class = "pre-scrollable">
        <ul class = "list-group">
          <!-- Display all courses not currently in role -->
          @foreach($courses as $course)
            <li id = "course-{{ $course->id }}" class = "list-group-item course-draggable" data-course-id = "{{ $course->id }}">
              <span class = "course-id" style = "display: none;">{{ $course->id }}</span>
              <strong><span class = "course-name">{{ $course->name }}</span></strong><br/>
              {{ $course->subtitle }}
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      // Hide users currently in role from main user list
      @foreach($current_users as $user)
        $('#request-users').val($('#request-users').val() + '{{ $user->id }},');

        $("#users ul li[data-user-id='{{ $user->id }}']").hide();
      @endforeach

      // Hide courses currently in role from main course list
      @foreach($current_courses as $course)
        $('#request-courses').val($('#request-courses').val() + '{{ $course->id }},');

        $("#courses ul li[data-course-id='{{ $course->id }}']").hide();
      @endforeach

      // Allow user items to be draggable
      $('.user-draggable').draggable({
        containment: "#dragzone",
        scroll: false,
        appendTo: 'body',
        cursor: 'move',
        revert: 'invalid',
        helper: 'clone',
      });

      // Allow users to be dropped into role
      $('#user-droppable').droppable({
        accept: '.user-draggable',
        tolerance: 'pointer',
        drop: function(event, item) {
          // Add further details to user item when added to role, for further editing
          $(this).append('<div class = "role-user"><span style = "display:none;" class = "role-user-id">'
           + $(item.draggable).find('.user-id').text() + ",</span>"
           + '<span class = "role-user-name">' + $(item.draggable).find('.user-name').text()
           + '</span><span style = "float:right;">'
           + '<i class="fa fa-minus-circle remove-user" aria-hidden="true"></i></span></div>');

           $('#request-users').val($('#request-users').val() + $(item.draggable).find('.user-id').text() + ',');

           $(item.draggable).hide();
        }
      });

      // Allow course items to be dragged
      $('.course-draggable').draggable({
        containment: "#dragzone",
        scroll: false,
        appendTo: 'body',
        cursor: 'move',
        revert: 'invalid',
        helper: 'clone'
      });

      // Allow course items to be dropped into role
      $('#course-droppable').droppable({
        accept: '.course-draggable',
        tolerance: 'pointer',
        drop: function(event, item) {
          // Add further details to course for futher editing in role
          $(this).append('<div class = "role-course"><span style = "display: none;" class = "role-course-id">'
           + $(item.draggable).find('.course-id').text() + ',</span><span class = "role-course-name">'
           + $(item.draggable).find('.course-name').text() + '</span><span style = "float:right;">'
           + '<i class="fa fa-minus-circle remove-course" aria-hidden="true"></i></span></div>');

           $('#request-courses').val($('#request-courses').val() + $(item.draggable).find('.course-id').text() + ',');

           $(item.draggable).hide();
        }
      });

      // If minus sign is clicked on user, then remove from role
      $(document).on('click', '.remove-user', function() {
        var user_id = $(this).parent().parent().find('.role-user-id').text().slice(0, -1);
        $('#users').find('#user-' + user_id).show();

        $(this).parent().parent().remove();
        $('#request-users').val($('#user-droppable').find('.role-user-id').text());
      });

      // If minus sign is clicked on course, then remove from role
      $(document).on('click', '.remove-course', function() {
        var course_id = $(this).parent().parent().find('.role-course-id').text().slice(0, -1);
        $('#courses').find('#course-' + course_id).show();

        $(this).parent().parent().remove();
        $('#request-courses').val($('#course-droppable').find('.role-course-id').text());
      });
    });
  </script>
@endsection
