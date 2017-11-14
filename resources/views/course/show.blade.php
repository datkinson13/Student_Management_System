@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">{{ $course->name }}
            <a class="btn btn-warning btn-lg" href="#" role="button">Edit Course</a>
            <a class="btn btn-success btn-lg" href="/course/{{ $course->id }}/email" role="button">Email Students</a>
        </h1>
        <p class="lead">{{ $course->subtitle }}</p>
        <a href="#">
            <button type="button" class="btn btn-primary btn-lg user-action-buttons" data-toggle="modal"
                    data-target="#course-enroll-modal-{{ $course->id }}">Enroll
            </button>
        </a>
        <p>{{ $course->StartDate->format('Y-m-d') }} - {{ $course->EndDate->format('Y-m-d') }} @ {{ $course->CourseTime }}</p>
        <hr class="my-4">
        <p>{{ $course->description }}</p>
    </div>

    <div class="modal fade" id="course-enroll-modal-{{ $course->id }}" tabindex="-1" role="dialog"
         aria-labelledby="course-enroll-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Enroll in: {{ $course->name }}?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to enroll in {{ $course->name }}?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/enrollments/{{ $course->id }}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <button type="submit" class="btn btn-primary">Enroll</button>
                    </form>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
