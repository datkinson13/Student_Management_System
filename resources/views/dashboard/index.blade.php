@extends('layouts.master')

@section('content')
    <h1>Dashboard</h1>

    <section class="row text-center placeholders">
        @foreach ($enrollments as $enrollment)
            <div class="col-6 col-sm-3 placeholder">
                <img src="data:image/gif;base64,{{ $enrollment->competencyStatus()['light'] }}" width="200" height="200"
                     class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                <h4>{{ $enrollment->course->name }}</h4>
                <div class="text-muted">{{ $enrollment->ExpiryDate }}</div>
            </div>
        @endforeach
    </section>

    <h2>My Competencies</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Date Completed</th>
                <th>Status</th>
                <th>Expiry Date</th>
                <th>Days remaining</th>
                <th>Calculated level</th>
            </tr>
            </thead>
            <tbody>
            @foreach($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->id }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->CompletedDate }}</td>
                    <td>{{ $enrollment->enrolment_status }}</td>
                    <td>{{ $enrollment->ExpiryDate }}</td>
                    <td>{{ $enrollment->daysRemaining() }}</td>
                    <td>{{ $enrollment->competencyStatus()['color'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection