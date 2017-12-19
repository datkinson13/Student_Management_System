@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css"/>
    <div id='calendar'></div>

    <!-- Modal -->
    <div class="modal fade" id="calendarSettings" tabindex="-1" role="dialog" aria-labelledby="calendarSettingsLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarSettingsLabel">Calendar Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="get" id="calSettings">
                    <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                            All changes are saved automatically
                        </div>
                        {{-- Put a whole heap of calendar options here. --}}
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="allCourses" id="allCourses">
                                All Courses
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="myEnrollment" id="myEnrollment">
                                My Enrollments
                            </label>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="enrollmentColor">MyEnrollments Color</label>
                            <input type="text" class="form-control" id="enrollmentColor" name="enrollmentColor" aria-describedby="emailHelp" value="#ff0000">
                        </div>
                        <div class="form-group">
                            <label for="courseColor">All Courses color</label>
                            <input type="text" class="form-control" id="courseColor" name="courseColor" aria-describedby="emailHelp" value="#ff0000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Load Defaults</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveOptions()">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/locale/en-au.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js"></script>

    <script>
        //
        // Form Save - jQuery Plugin
        //
        ;(function ($) {
            $.fn.toJSON = function () {
                var $elements = {};
                var $form = $(this);
                $form.find('input, select, textarea').each(function () {
                    var name = $(this).attr('name')
                    var type = $(this).attr('type')
                    if (name) {
                        var $value;
                        if (type == 'radio') {
                            $value = $('input[name=' + name + ']:checked', $form).val()
                        } else if (type == 'checkbox') {
                            $value = $(this).is(':checked')
                        } else {
                            $value = $(this).val()
                        }
                        $elements[$(this).attr('name')] = $value
                    }
                });
                return JSON.stringify($elements)
            };
            $.fn.fromJSON = function (json_string) {
                var $form = $(this)
                var data = JSON.parse(json_string)
                $.each(data, function (key, value) {
                    var $elem = $('[name="' + key + '"]', $form)
                    var type = $elem.first().attr('type')
                    if (type == 'radio') {
                        $('[name="' + key + '"][value="' + value + '"]').prop('checked', true)
                    } else if (type == 'checkbox' && (value == true || value == 'true')) {
                        $('[name="' + key + '"]').prop('checked', true)
                    } else {
                        $elem.val(value)
                    }
                })
            };
        }(jQuery));
        //
        // Form Save - jQuery Plugin
        //

        $(document).ready(function () {
            $('#calendar').fullCalendar({
                "header": {
                    "left": "prev,next today myCustomButton",
                    "center": "title",
                    "right": "month,agendaWeek,agendaDay"
                },
                "eventLimit": true,
                "firstDay": 1,
                "customButtons": {
                    "myCustomButton": {
                        "text": "Calendar Settings",
                        "click": function () {
                            $("#calendarSettings").modal();
                        }
                    }
                },
                "events": {
                    "url": "{{route('calendar.events')}}",
                    "type": 'GET',
                    "data": {
                        "myEnrollments": function () {
                            // Single line if statement, if the value is checked return 1 (true) else 0 (false).
                            // Sending 1 or 0 instead of just true/false because PHP can't eval "true" or "false"
                            // Without additional processing, this makes things more simple in the PHP backend.
                            return document.getElementById('myEnrollment').checked ? 1 : 0;
                        },
                        "allCourses": function () {
                            return document.getElementById('allCourses').checked ? 1 : 0;
                        },
                        "courseColor": function () {
                            return document.getElementById('courseColor').value;
                        },
                        "enrollmentColor": function () {
                            return document.getElementById('enrollmentColor').value;
                        }
                    }
                }
            });

            $('#calendarSettings').on('show.bs.modal', function () {
                loadOptions();
            });

            $('#calendarSettings').on('hide.bs.modal', function () {
                saveOptions();
            });

            loadOptions();
        });

        function loadOptions() {
            if (localStorage['calSettings']) {
                console.log("Loading form data...");
                console.log(JSON.parse(localStorage['calSettings']));
                $("form#calSettings").fromJSON(localStorage['calSettings']);
                $('#calendar').fullCalendar( 'refetchEvents' );
            } else {
                // Define the default options.
                document.getElementById('allCourses').checked = true;
                document.getElementById('myEnrollment').checked = false;
                saveOptions();
            }
        }

        function saveOptions() {
            if (typeof(Storage) !== "undefined") {
                console.log("Saving form data...");
                var data = $("form#calSettings").toJSON();
                console.log(data);
                localStorage['calSettings'] = data;
                $('#calendar').fullCalendar( 'refetchEvents' );
            } else {
                // Sorry! No Web Storage support.. We'll have to use AJAX and PHP sessions.
                // This will need to come later as it is not a priority.

                // Workflow:
                // Hide the save notification.
                // Send the data to the session.
                // Show save notification.
            }
        }
    </script>
@endsection
