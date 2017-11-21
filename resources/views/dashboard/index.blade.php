@extends('layouts.master')

@section('content')
    <h1>Dashboard</h1>

    @if ($currentUser)
        <section class="row text-center placeholders">
            @foreach ($enrollments as $enrollment)
                <div class="col-6 col-sm-3 placeholder">
                    <img src="data:image/gif;base64,{{ $enrollment->competencyStatus()['light'] }}" width="200" height="200"
                         class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                    <h4>{{ $enrollment->course->name }}</h4>
                    <div class="text-muted">
                        {{ $enrollment->ExpiryDate }}
                        @if ($currentUser->isEmployer())
                            - {{ $enrollment->user->Fname }} {{ $enrollment->user->Lname }}
                        @endif
                    </div>
                </div>
                @if ($loop->iteration == 4)
                    {{-- This is the 4th loop, break now. We are only showing the 4 closest to expiry. --}}
                    @break
                @endif
            @endforeach
        </section>

        @if ($currentUser->isEmployer())
            <h2>Employee Competencies</h2>
        @else
            <h2>My Competencies</h2>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    @if ($currentUser->isEmployer())
                        <th>Employee</th>
                    @endif
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
                        @if ($currentUser->isEmployer())
                            <td>{{ $enrollment->user->Fname }} {{ $enrollment->user->Lname }}</td>
                        @endif
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
    @else
        <p>To gain full access to the dashboard please login.</p>
    @endif
@endsection