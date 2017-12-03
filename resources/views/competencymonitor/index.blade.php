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
              <h3 class = "business-role-{{ $businessRole->id }}">{{ $businessRole->name }}</h3>
              <div>
                @foreach($courses[$businessRole->businessrole_id] as $course)
                  <p class = "course-{{ $course->id }}">{{ $course->name }}</p><br/>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
    <div class = "col-md-9">
      <canvas id="timeline" width="640" height="360"></canvas>
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')
<script>
  $('#user-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

  $('.business-role-accordion').accordion({
    heightStyle: 'content',
    autoHeight:false
  });

  var ctx = document.getElementById("timeline").getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: ["Course1", "Course2", "Course3"],
          datasets: [{
              label: '# of Votes',
              backgroundColor: "#000000",
              data: [12, 19, 3, 5, 7, 3],
              borderWidth: 1
          }]
      },
      options: {
          legend: {
              display: false
          },
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true
                  },
                  barPercentage: 0.03
              }],
              xAxes: [{
                  position: 'top'
              }]
          }
      }
  });

</script>
@endsection
