@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">{{ $course->name }}
            <a class="btn btn-warning btn-lg" href="#" role="button">Edit Course</a>
            <a class="btn btn-success btn-lg" href="/course/{{ $course->id }}/email" role="button">Email Students</a>
        </h1>
        <p class="lead">{{ $course->subtitle }}</p><a class="btn btn-primary btn-lg" href="#" role="button">Enroll</a>
        <p>{{ $course->StartDate->format('Y-m-d') }} - {{ $course->EndDate->format('Y-m-d') }} @ {{ $course->CourseTime }}</p>
        <hr class="my-4">
        <p>{{ $course->description }}</p>
    </div>
@endsection
