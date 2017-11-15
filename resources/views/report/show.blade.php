@extends('layouts.master')

@section('content')
<h1>{{ $report->report_name }}</h1>

<div class = "col-md-8 col-md-offset-4">
  <canvas id = "user-chart" width = "640" height = "360"></canvas>
</div>

@endsection

@section('footer-scripts')
<script>
var ctx = document.getElementById("user-chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: '{{ $report->type }}',
    data: {
        labels: [{!! $report->label !!}],
        datasets: [{
            data: [{!! $report->data !!}],
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
        {!! $report->options !!}
    }
});
</script>
@endsection
