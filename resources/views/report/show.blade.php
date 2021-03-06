@extends('layouts.master')

@section('content')
<h1>{{ $report->report_name }}</h1>

<div class = "row">
  <div class = "col-md-7">
    <!-- Display report graph -->
    <canvas id = "user-chart" width = "640" height = "360"></canvas>
  </div>
  <div class = "col-md-5">
    <!-- Display create report form preset with current settings -->
    <form action = "/reports/{{ $report->id }}" method = "POST">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}

      <div class = "form-group">
        <label for = "report_name">Report Name: </label>
        <input type="text" class="form-control" value = "{{ $report->report_name}}" id="report_name" name="report_name" aria-describedby="report_name" placeholder="Report name...">
      </div>

      <div class = "form-group">
        <label for ="report_entity">Report Entity: </label>
        <select class = "form-control" id = "report_entity" name = "report_entity">
          @if($report->report_entity == "users")
            <option value = "users" selected>Users</option>
          @else
            <option value = "users">Users</option>
          @endif
          @if($report->report_entity == "enrollments")
            <option value = "enrollments" selected>Enrolments</option>
          @else
            <option value = "enrollments">Enrolments</option>
          @endif
          @if($report->report_entity == "courses")
            <option value = "courses" selected>Courses</option>
          @else
            <option value = "courses">Courses</option>
          @endif
          @if($report->report_entity == "tickets")
            <option value = "tickets" selected>Tickets</option>
          @else
            <option value = "tickets">Tickets</option>
          @endif
          @if($report->report_entity == "business_roles")
            <option value = "business_roles" selected>Business Roles</option>
          @else
            <option value = "business_roles">Business Roles</option>
          @endif
        </select>
      </div>

      <div class = "form-group">
        <label for ="chart_type">Chart type: </label>
        <select class = "form-control" id = "chart_type" name = "chart_type">
          @if($report->type == "line")
            <option value = "line" selected>Line chart</option>
          @else
            <option value = "line">Line chart</option>
          @endif
          @if($report->type == "bar")
            <option value = "bar" selected>Bar chart</option>
          @else
            <option value = "bar">Bar chart</option>
          @endif
          @if($report->type == "radar")
            <option value = "radar" selected>Radar chart</option>
          @else
            <option value = "radar">Radar chart</option>
          @endif
          @if($report->type == "pie")
            <option value = "pie" selected>Pie chart</option>
          @else
            <option value = "pie">Pie chart</option>
          @endif
          @if($report->type == "doughnut")
            <option value = "doughnut" selected>Doughnut chart</option>
          @else
            <option value = "doughnut">Doughnut chart</option>
          @endif
          @if($report->type == "polarArea")
            <option value = "polarArea" selected>Polar Area chart</option>
          @else
            <option value = "polarArea">Polar Area chart</option>
          @endif
        </select>
      </div>
      <br/>
      <button class="btn btn-primary user-edit-buttons" type="submit">Update Report</button>
    </form>
  </div>
</div>

<div class="pre-scrollable table-responsive col-md-12" style = "padding-top: 30px;">
  <!-- Display report data in table below graph -->
  <table class="table table-striped">
    <thead>
      <tr>
        @foreach($columns as $heading)
            <th>{{ $heading }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach($data as $item)
        <tr>
          @foreach($columns as $detail)
            <td>{{ $item->$detail }}</td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('footer-scripts')
<script>
// Use chartjs to create report graph for display
var ctx = document.getElementById("user-chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: '{{ $report->type }}',
    data: {
        labels: {!! $labels !!},
        datasets: [{
            data: [
              @for($i = 0; $i < 12; $i++)
                {{ $chart_data[$i] }},
              @endfor
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true,
                  max:25
              }
          }],
          xAxes: [{
            stacked: false,
            beginAtZero: true,
            scaleLabel: {
              labelString: 'Month'
            },
            ticks: {
              stepSize: 1,
              min: 0,
              autoSkip: false
            }
          }]
      },
      legend: {
        display: false
      }
    }
});
</script>
@endsection
