@extends('layouts.master')

@section('content')
<h1>Monitor competencies</h1>
<div id = "competency-space">
  <div class = "row">
  <div id = "user-accordion" class = "col-md-3">
    <!-- @foreach($users as $user)
      <h3>{{ $user->Fname }} {{ $user->Lname }}</h3>
      <div class = "business-role-accordion">
        @foreach($business_roles as $business_role)
          <h3>{{ $business_role->name }}</h3>
          <div>
            @foreach($courses as $course)
              <p>{{ $course->name }}</p>
            @endforeach
          </div>
        @endforeach
      </div>
    @endforeach -->
    <h3>John Smith</h3>
    <div  class = "business-role-accordion">
      <h3 id = "prototype-image-1">Business Role 1</h3>
      <div>
        <p>Skills Course 1</p>
        <p>Skills Course 2</p>
        <p>Skills Course 3</p>
      </div>
      <h3 id = "prototype-image-2">Business Role 2</h3>
      <div>
        <p>Skills Course 4</p>
        <p>Skills Course 5</p>
        <p>Skills Course 6</p>
      </div>
    </div>
  </div>
  <div class = "col-md-9">
    <img id = "prototype-image" src = "/images/CompetencyMonitor1.png" width = "710px" style = "margin-left: 50px; padding-top: 10px;" />
  </div>
</div>
</div>
@endsection

@section('footer-scripts')
<script>
  $('#user-accordion').accordion({
    autoHeight:true
  });
  $('.business-role-accordion').accordion();

  $('#prototype-image-1').on('click', function() {
    $('#prototype-image').prop('src', '/images/CompetencyMonitor1.png');
  });

  $('#prototype-image-2').on('click', function() {
    $('#prototype-image').prop('src', '/images/CompetencyMonitor2.png');
  });
</script>
@endsection
