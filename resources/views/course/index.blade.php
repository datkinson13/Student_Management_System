@extends('layouts.master')

@section('content')
    <a href = "/course/create"><button class = "btn btn-primary user-profile-buttons">Add Course</button></a>
    <h1>Courses</h1>
    <div class="card-deck">
        @foreach ($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card" style="width: 20rem;">
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
        @for($i = 1; $i < 11; $i++)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <h4 class="card-title">Course {{ $i }}</h4>
                        <p class="card-text">Some quick example text to build on the course title and make up the
                            bulk
                            of
                            the
                            card's content.</p>
                        <a href="/course/{{ $i }}" class="btn btn-primary">View Course</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        @endfor
    </div>

@endsection