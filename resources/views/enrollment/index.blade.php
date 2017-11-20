@extends('layouts.master')

@section('content')
    <h1>My Enrollments</h1>
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
                <th>Actions</th>
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
                    <td>
                        <a href="#">
                            <button type="button" class="btn btn-primary user-action-buttons" data-toggle="modal"
                                    data-target="#enroll-update-modal" data-id="{{ $enrollment->id }}" data-title="{{ $enrollment->course->name }}">Update
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="enroll-update-modal" tabindex="-1" role="dialog"
             aria-labelledby="enroll-update-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="enroll-update-modal-label">Update Enrollment: <span id="enrollment"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <form method="POST" action="/" id="enroll-form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="enrolment_status">Enrollment Status</label>
                                <select class="form-control" id="enrolment_status" name="enrolment_status">
                                    <option>In Progress</option>
                                    <option>Completed</option>
                                    <option>Failed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="CompletedDate">Date Completed</label>
                                <input type="date" class="form-control" id="CompletedDate" name="CompletedDate" aria-describedby="CompletedDate">
                            </div>
                        </div>

                        <div class="modal-footer">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit" class="btn btn-primary">Update</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('page-script')
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#enroll-update-modal').on("show.bs.modal", function (e) {
                $("#enrollment").html($(e.relatedTarget).data('title'));
                $("#enroll-form").attr("action", "/enrollment/" + $(e.relatedTarget).data('id'));
            });
        });
    </script>
@endsection
