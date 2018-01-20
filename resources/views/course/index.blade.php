@extends('layouts.master')

@section('content')
    <a href = "/course/create"><button class = "btn btn-primary user-profile-buttons">Add Course</button></a>
    <h1>Courses</h1>
    <div class="card-deck">
        @foreach ($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="card" style="width: 20rem; height: 380px; margin: 10px;">
                    <div class="card-body">
                        <h4 class="card-title">{{ $course->name }}</h4>
                        <p class="card-text">{{ $course->subtitle }}</p>
                        <a href="/course/{{ $course->id }}" class="btn btn-primary">View Course</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated {{ $course->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
