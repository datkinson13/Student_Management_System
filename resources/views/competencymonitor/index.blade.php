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
                  <p data-course = "{{ $course->course_id }}" class = "course-{{ $course->id }}">{{ $course->name }}</p><br/>
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
      @foreach($enrolments as $enrolment)
        if(courseIds[i] == "<?= $enrolment->course_id ?>" && userId == "<?= $enrolment->user_id ?>") {
          var enrolmentCompleted = "{{ $enrolment->CompletedDate }}";
          var enrolmentExpired = "{{ $enrolment->ExpiryDate }}";

          rows.push([
            String(i),
            courseNames[i],
            new Date(enrolmentCompleted),
            new Date(enrolmentExpired)
          ]);
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

    dataTable.addColumn({ type: 'string', id: 'ID' });
    dataTable.addColumn({ type: 'string', id: 'Course' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentCompleted' });
    dataTable.addColumn({ type: 'date', id: 'EnrolmentExpired' });
    dataTable.addRows(rows);

    var options = {
      timeline: { showRowLabels: false },
      hAxis: {
        viewWindowMode:'explicit',
        viewWindow: {

        },
        minValue: new Date(2012, 0, 0),
        maxValue: new Date(2024, 0, 0),
      },
    };

    chart.draw(dataTable, options);
  }
</script>
@endsection
