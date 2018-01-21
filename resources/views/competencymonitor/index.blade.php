@extends('layouts.master')

@section('content')
<h1>Monitor competencies</h1>
<div id = "competency-space">
  <div class = "row">
    <div id = "user-accordion" class = "col-md-3">
      <!-- Display all users in an accordion -->
      @foreach($users as $user)
        <h3 class = "user-name" id = "user-{{ $user->id }}">{{ $user->Fname }} {{ $user->Lname }}</h3>
        <div>
          <div class = "business-role-accordion">
            <!-- Display all user's business roles in nested accordion -->
            @foreach($businessRoles[$user->id] as $businessRole)
              <h3 class = "business-role-item" data-user = "{{ $user->id }}" id = "user-{{ $user->id }}-business-role-{{ $businessRole->id }}">{{ $businessRole->name }}</h3>
              <div class = "business-role-{{ $businessRole->id }}-courses">
                <!-- Display all courses within each business role -->
                @foreach($courses[$businessRole->businessrole_id] as $course)
                  <p id = "user-{{ $user->id }}-business-role-{{ $businessRole->id }}-course-{{ $course->id }}" data-course = "{{ $course->course_id }}" class = "course-{{ $course->id }}">{{ $course->name }}</p><br/>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
    <!-- Display timeline for google chart API -->
    <div class = "col-md-9">
      <div id="timeline" style="width: 100%; height: 360px;"></div>
    </div>
  </div>
  <div class = "row">
    <div style = "padding-left: 45%;">
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')

<script>
  $(document).ready(function() {
    var today = new Date();
    var dateLimit = new Date();
    var trafficLights = [];

    // Set date limit for traffic light signal - 90 days
    dateLimit.setDate(today.getDate() + 90);

    @foreach($users as $user)
      // For each user, set the traffic light signal initially to red
      $('#user-{{ $user->id }}').prepend("<span class = 'traffic-light' style = 'color: rgb(255,0,0);'><i class='fa fa-circle' aria-hidden='true'></i></span>");

      @foreach($businessRoles[$user->id] as $businessRole)
        /*
         * There is a problem that is more of an exception, if the first item is
         * green/red/orange, and all following items don't have an existing enrolment
         * then it will show the first enrolment color, rather than show as red (No enrolment)
        */

        var signalCheck = false;

        // For each business role, set the traffic light signal initially to green
        $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').prepend("<span class = 'traffic-light' style = 'color: rgb(0,128,0);'><i class='fa fa-circle' aria-hidden='true'></i></span>");

        // Loop through the courses under the relevant user's business role
        $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').next().children().each(function() {
          @foreach($enrolments as $enrolment)
            // Compare each enrolment in the database to the user/role/course list
            if($(this).data('course') == "<?= $enrolment->course_id ?>" && "<?= $user->id ?>" == "<?= $enrolment->user_id ?>") {
              // If matching enrolment has an expiry date between today and +90 days then set business role as orange
              if(Date.parse("<?= $enrolment->ExpiryDate ?>") < dateLimit && Date.parse("<?= $enrolment->ExpiryDate ?>") > today) {
                $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "rgb(255,128,0)");
              // If matching enrolment has an expiry date before today then set business role as red
              } else if(Date.parse("<?= $enrolment->ExpiryDate ?>") < today) {
                $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "rgb(255,0,0)");
                return false;
              }

              // Flag that an enrolment was found in the database that matched the user/role/course
              signalCheck = true;
            }
          @endforeach

          // If no matching enrolment was found, then default the busienss role to red
          if(signalCheck == false) {
            $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "rgb(255,0,0)");
            return false;
          }

        });
      @endforeach

      // Loop through each business role for the user
      $('#user-{{ $user->id }}').next().find('.business-role-item').each(function() {
        // If the business role is red, then set the user to red
        if($(this).find('.traffic-light').css('color') == 'rgb(255, 0, 0)') {
          $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'rgb(255, 0, 0)');
          return false;
        // If the business role is orange, then check other roles for red then set to orange
        } else if($(this).find('.traffic-light').css('color') == 'rgb(255, 128, 0)') {

          var redCheck = false;

          $('#user-{{ $user->id }}').next().find('.business-role-item').each(function() {
            if($(this).find('.traffic-light').css('color') == 'rgb(255, 0, 0)') {
              redCheck = true;
            }
          });

          // If another role is red, then set as red instead of orange
          if(redCheck) {
            $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'rgb(255, 0, 0)');
          } else {
            $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'rgb(255, 128, 0)');
          }

          // Set role to green if no other role is red/orange
        } else if($(this).find('.traffic-light').css('color') == 'rgb(0, 128, 0)') {
          $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'rgb(0, 128, 0)');
        }
      });
    @endforeach

    // Hide the timeline each time a user's name is clicked, to reshow when their role is clicked
    $('.user-name').on('click', function() {
      $('#timeline').hide();
    });

  });
</script>

<script>
  var rows = [];
  var courseNames = [];

  // When a business role item is clicked, generate the timeline for the user's enrolments
  $('.business-role-item').on('click', function() {
    var courseIds = [];
    var userId = $(this).data('user');

    rows.length = 0;
    courseNames.length = 0;

    // Add each course name/id to the course arrays for timeline
    $(this).next().children().each(function() {
      if($(this).text() != "") {
        courseNames.push($(this).text());
      }

      if($(this).data('course') != null) {
        courseIds.push($(this).data('course'));
      }
    });

    // For each course in this business role, push to timeline generator
    for(var i = 0; i < courseIds.length; i++) {

      rows.push([courseNames[i], new Date('2017-01-01'), new Date('2017-01-01')]);

      // If there is an existing enrolment, take the date details for timeline generator
      @foreach($enrolments as $enrolment)
        if(courseIds[i] == "<?= $enrolment->course_id ?>" && userId == "<?= $enrolment->user_id ?>") {
          var enrolmentCompleted = "{{ $enrolment->CompletedDate }}";
          var enrolmentExpired = "{{ $enrolment->ExpiryDate }}";

          rows[i][1] = new Date(enrolmentCompleted);
          rows[i][2] = new Date(enrolmentExpired);
        }
      @endforeach
    }

    // Show timeline display and generate timeline
    $('#timeline').show();
    drawChart();

  });

  // Set user accordion
  $('#user-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

  // Set business role accordion
  $('.business-role-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  // Use google charts api for timeline
  google.charts.load('current', {'packages':['timeline']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var container = document.getElementById('timeline');
    var chart = new google.visualization.Timeline(container);
    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn({ type: 'string', id: 'Course' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentCompleted' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentExpired' });
    // Pass the rows array with course/enrolment data to timeline generator
    dataTable.addRows(rows);

    var options = {
      hAxis: {
        viewWindowMode:'explicit',
        viewWindow: {

        },
        minValue: new Date(2012, 0, 0),
        maxValue: new Date(2024, 0, 0),
      },
      colors: ['#000000'],
    };

    chart.draw(dataTable, options);
  }
</script>

@endsection
