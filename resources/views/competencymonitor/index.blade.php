@extends('layouts.master')

@section('content')
<h1>Monitor competencies</h1>
<div id = "competency-space">
  <div class = "row">
    <div id = "user-accordion" class = "col-md-3">
      @foreach($users as $user)
        <h3 id = "user-{{ $user->id }}">{{ $user->Fname }} {{ $user->Lname }}</h3>
        <div>
          <div class = "business-role-accordion">
            @foreach($businessRoles[$user->id] as $businessRole)
              <h3 class = "business-role-item" data-user = "{{ $user->id }}" id = "user-{{ $user->id }}-business-role-{{ $businessRole->id }}">{{ $businessRole->name }}</h3>
              <div class = "business-role-{{ $businessRole->id }}-courses">
                @foreach($courses[$businessRole->businessrole_id] as $course)
                  <p id = "user-{{ $user->id }}-business-role-{{ $businessRole->id }}-course-{{ $course->id }}" data-course = "{{ $course->course_id }}" class = "course-{{ $course->id }}">{{ $course->name }}</p><br/>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
    <div class = "col-md-9">
      <div id="timeline" style="width: 100%; height: 360px;"></div>
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

    dateLimit.setDate(today.getDate() + 90);

    @foreach($users as $user)
      $('#user-{{ $user->id }}').prepend("<span class = 'traffic-light' style = 'color: green;'><i class='fa fa-circle' aria-hidden='true'></i></span>");

      @foreach($businessRoles[$user->id] as $businessRole)
        $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').prepend("<span class = 'traffic-light' style = 'color: red;'><i class='fa fa-circle' aria-hidden='true'></i></span>");

        $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').next().children().each(function() {
          @foreach($enrolments as $enrolment)
            if($(this).data('course') == "<?= $enrolment->course_id ?>" && "<?= $user->id ?>" == "<?= $enrolment->user_id ?>") {
              if(Date.parse("<?= $enrolment->ExpiryDate ?>") > dateLimit) {
                $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "green");
              } else if(Date.parse("<?= $enrolment->ExpiryDate ?>") < dateLimit && Date.parse("<?= $enrolment->ExpiryDate ?>") > today) {
                $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "orange");
              } else {
                $('#user-{{ $user->id }}-business-role-{{ $businessRole->id }}').find(".traffic-light").css("color", "red");
              }
            }
          @endforeach
        });
      @endforeach

      alert($('#user-{{ $user->id }}').find('.business-role-accordion'));

      /*
      $('#user-{{ $user->id }}').next().next().children('h3').each(function() {
        if($(this).find(.'traffic-light').css('color') == 'red') {
          $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'red');
          return false;
        } else if($(this).find(.'traffic-light').css('color') == 'orange') {
          $('#user-{{ $user->id }}').find('.traffic-light').css('color', 'orange');
          return false;
        }
      });*/
    @endforeach
  });
</script>

<script>
  var rows = [];
  var courseNames = [];

  $('.business-role-item').on('click', function() {
    var courseIds = [];
    var userId = $(this).data('user');

    rows.length = 0;
    courseNames.length = 0;

    $(this).next().children().each(function() {
      if($(this).text() != "") {
        courseNames.push($(this).text());
      }

      if($(this).data('course') != null) {
        courseIds.push($(this).data('course'));
      }
    });

    for(var i = 0; i < courseIds.length; i++) {

      rows.push([courseNames[i], new Date('2017-01-01'), new Date('2017-01-01')]);

      @foreach($enrolments as $enrolment)
        if(courseIds[i] == "<?= $enrolment->course_id ?>" && userId == "<?= $enrolment->user_id ?>") {
          var enrolmentCompleted = "{{ $enrolment->CompletedDate }}";
          var enrolmentExpired = "{{ $enrolment->ExpiryDate }}";

          rows[i][1] = new Date(enrolmentCompleted);
          rows[i][2] = new Date(enrolmentExpired);

          /*if(rows[i][2] > dateLimit) {
            $(this).find(".traffic-light").css("color", "green");
            $(this).parent().parent().prev().find(".traffic-light").css("color", "green");
          }*/
        }
      @endforeach
    }

    drawChart();

  });

  $('#user-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

  $('.business-role-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['timeline']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var container = document.getElementById('timeline');
    var chart = new google.visualization.Timeline(container);
    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn({ type: 'string', id: 'Course' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentCompleted' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentExpired' });
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
