<html>
  <head>
  </head>
  <body>
    <p>Please see net training liability as of {{ $today }}, see information below:</p><br/>
    <h1>Net Training Liability</h1>
    <table class="table table-striped" id = "expense_table">
      <thead>
        <tr>
          <th><span style = "text-decoration: underline;"><em>Training Expense</em></span></th>
          <th><span id = "immediate" title = "Expired or no enrolments">Immediate</span></th>
          <th><span id = "approaching" title = "Enrolment expiring within 90 days">Approaching</span></th>
          <th><span id = "distant" title = "Enrolment expiring sometime after 90 days">Distant</span></th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop through each business role -->
        @foreach($business_roles as $business_role)
          <tr>
            <td><strong>{{ $business_role->name }}</strong></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <!-- For each role, loop through course and enrolments -->
          @foreach($courses[$business_role->id] as $course)
            @foreach($green_enrolments["$business_role->id-$course->course_id"] as $green_enrolment)
              @foreach($yellow_enrolments["$business_role->id-$course->course_id"] as $yellow_enrolment)
                @foreach($red_enrolments["$business_role->id-$course->course_id"] as $red_enrolment)
                  @foreach($pending_enrolments["$business_role->id-$course->course_id"] as $pending_enrolment)
                    @foreach($completed_enrolments["$business_role->id-$course->course_id"] as $completed_enrolment)
                      @foreach($users[$business_role->id] as $user)
                        <!-- Calculate all cost depending on expiry dates and apply to relevant column -->
                        <tr>
                          <td style = "padding-left: 30px;">{{ $course->name }}</td>
                          <td>${{ $course->cost * ($red_enrolment->total + ($user->total - ($pending_enrolment->total + $completed_enrolment->total))) }}</td>
                          <td>${{ $course->cost * ($yellow_enrolment->total )}}</td>
                          <td>${{ $course->cost * ($green_enrolment->total )}}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  @endforeach
                @endforeach
              @endforeach
            @endforeach
          @endforeach
        @endforeach

        <tr style = "border-top: 2px solid #000000; border-bottom: 2px solid #000000;">
          <!-- Calculate total for each column -->
          <td><strong>Total Expense:</strong></td>
          <td><strong>${{ $immediate_total }}</strong></td>
          <td><strong>${{ $approaching_total }}</strong></td>
          <td><strong>${{ $distant_total }}</strong></td>
        </tr>
      </tbody>
    </table><br/><br/>

    <p>Kind Regards,<br/>
      Canopi Learning Solutions</p>

  </body>
</html>
