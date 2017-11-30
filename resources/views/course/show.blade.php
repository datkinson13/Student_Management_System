@extends('layouts.master')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
               aria-selected="true">Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="assignments-tab" data-toggle="tab" href="#assignments" role="tab"
               aria-controls="assignments" aria-selected="false">Assignments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab"
               aria-controls="documents" aria-selected="false">Documents</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="jumbotron">
                <h1 class="display-3">{{ $course->name }}
                    <a class="btn btn-warning btn-lg" href="#" role="button">Edit Course</a>
                    <a class="btn btn-success btn-lg" href="/course/{{ $course->id }}/email" role="button">Email
                        Students</a>
                </h1>
                <p class="lead">{{ $course->subtitle }}</p>
                @if (count($enrolledUsers) > 0)
                    <a href="#">
                        <button type="button" class="btn btn-danger btn-lg user-action-buttons" data-toggle="modal"
                                data-target="#course-withdraw-modal-{{ $course->id }}">Withdraw
                        </button>
                    </a>
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
                                <form method="POST" action="{{ route('enrollment.withdraw') }}">
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        @if ($currentUser->isEmployer() || $currentUser->hasAccess(['users-edit-enrollment']))
                                            <div class="form-group">
                                                <label for="enrolment_status">Select the employee you wish to
                                                    withdraw:</label>
                                                <select class="form-control" id="enrollment_id" name="enrollment_id">
                                                    @foreach ($enrolledUsers as $enrollment)
                                                        <option value="{{ $enrollment->id }}">{{ $enrollment->user->Fname }} {{ $enrollment->user->Lname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            Are you sure you want to withdraw from {{ $course->name }}?
                                            <input type="hidden" value="{{ $enrolledUsers->id }}" name="enrollment_id">
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Withdraw</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if (count($nonEnrolledUsers) > 0)
                    <a href="#">
                        <button type="button" class="btn btn-primary btn-lg user-action-buttons" data-toggle="modal"
                                data-target="#course-enroll-modal-{{ $course->id }}">Enroll
                        </button>
                    </a>
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
                                        @if ($currentUser->isEmployer() || $currentUser->hasAccess(['users-edit-enrollment']))
                                            <div class="form-group">
                                                <label for="enrolment_status">Select the employee you wish to
                                                    enroll:</label>
                                                <select class="form-control" id="user_id" name="user_id">
                                                    @foreach ($nonEnrolledUsers as $employee)
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
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                <p>{{ $course->StartDate->format('Y-m-d') }} - {{ $course->EndDate->format('Y-m-d') }}
                    @ {{ $course->CourseTime }}</p>
                <hr class="my-4">
                <p>${{ $course->cost }}</p>
                <p>{{ $course->description }}</p>
            </div>
        </div>
        <div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="assignments-tab">
            <p>List assignments and stuff here.</p>
        </div>
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
            <p>Allow student to upload course documents and stuff here.</p>
        </div>
@endsection
