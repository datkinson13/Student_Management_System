@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ route('course.store') }}">
        {{ csrf_field() }}
        <div class="jumbotron">
            <a href="/course/create">
                <button class="btn btn-primary user-profile-buttons">Save</button>
            </a>
            <div class="form-group">
                <input type="text" class="form-control-lg" name="name" id="name" placeholder="Course Title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="subtitle">
            </div>
            <hr class="my-4">
            <div class="bootstrap-timepicker">
                <label for="CourseTime">Course Time: </label>
                <input id="CourseTime" name="CourseTime" type="text" class="input-small form-control">
                <span class="oi" data-glyph="clock"></span>
            </div>
            <div class="form-group">
                <label for="StartDate">Start Date: </label>
                <input type="date" class="form-control" name="StartDate" id="StartDate">
            </div>
            <div class="form-group">
                <label for="EndDate">End Date: </label>
                <input type="date" class="form-control" name="EndDate" id="EndDate">
            </div>
            <div class="form-group">
                <label for="days_valid">Competency valid for (days): </label>
                <input type="number" class="form-control" name="days_valid" id="days_valid">
            </div>
            <div class="form-group">
                <label for="days_valid">Cost ($): </label>
                <input type="number" class="form-control" name="cost" id="cost">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" id="description" placeholder="Description...."></textarea>
            </div>
            @can('assignFacilitator', App\Course::class)
                <div class="form-group">
                    <label for="user_id">Facilitator: </label>
                    <select name="user_id" id="user_id" class="custom-select" required>
                        <option selected disabled>Who should facilitate this course?</option>
                        @foreach (\App\Role::where('slug','facilitator')->first()->Users as $user)
                            <option value="{{ $user->id }}">{{ $user->Fname }} {{ $user->Lname }}</option>
                        @endforeach
                    </select>
                </div>
            @endcan
        </div>
    </form>
@endsection

@section('page-script')
    <script type="text/javascript" src="/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#CourseTime').timepicker({
                template: false,
                showInputs: false,
                minuteStep: 5
            });
        } );
    </script>
@endsection