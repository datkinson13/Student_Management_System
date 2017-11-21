@extends('layouts.master')

@section('content')
    <div class="jumbotron">
        <h1 class="display-3">{{ $course->name }}
            <a class="btn btn-warning btn-lg" href="#" role="button">Edit Course</a>
            <a class="btn btn-success btn-lg" href="/course/{{ $course->id }}/email" role="button">Email Students</a>
        </h1>
        <p class="lead">{{ $course->subtitle }}</p>
        @if ($enrollment = \App\Enrollment::where('user_id', \Auth::user()->id)->where('course_id', $course->id)->first())
            <a href="#">
                <button type="button" class="btn btn-danger btn-lg user-action-buttons" data-toggle="modal"
                        data-target="#course-withdraw-modal-{{ $course->id }}">Withdraw
                </button>
            </a>
        @else
            <a href="#">
                <button type="button" class="btn btn-primary btn-lg user-action-buttons" data-toggle="modal"
                        data-target="#course-enroll-modal-{{ $course->id }}">Enroll
                </button>
            </a>
        @endif
        <p>{{ $course->StartDate->format('Y-m-d') }} - {{ $course->EndDate->format('Y-m-d') }}
            @ {{ $course->CourseTime }}</p>
        <hr class="my-4">
        <p>{{ $course->description }}</p>
    </div>
    @if ($enrollment)
        <div class="modal fade" id="course-withdraw-modal-{{ $course->id }}" tabindex="-1" role="dialog"
             aria-labelledby="course-withdraw-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Withdraw from: {{ $course->name }}?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to withdraw from {{ $course->name }}?
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('enrollment.destroy', $enrollment->id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Withdraw</button>
                        </form>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    @else
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
                    <form method="POST" action="{{ route('enrollment.store') }}">
                        <div class="modal-body">
                            @if ($currentUser->isEmployer())
                                <div class="form-group">
                                    <label for="enrolment_status">Select the employee you wish to enroll:</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        @foreach ($currentUser->employer->employees as $employee)
                                            <option value="{{ $employee->user->id }}">{{ $employee->user->Fname }} {{ $employee->user->Lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                Are you sure you want to enroll in {{ $course->name }}?
                            @endif
                        </div>
                        <div class="modal-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            {{ method_field('POST') }}
                            <button type="submit" class="btn btn-primary">Enroll</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
