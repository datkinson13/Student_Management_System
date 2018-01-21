@extends('layouts.master')

@section('content')
<button class = "btn btn-primary" style = "float: right; margin-left: 20px;" type = "button" id = "email_button" data-toggle="modal"
        data-target="#training-liability-modal">Email Accounts</button>
<div class="dropdown" style = "float:right;">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Export
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#" id = "excel_button">as Excel</a>
    <a class="dropdown-item" href="#" id = "word_button">as Word</a>
    <a class="dropdown-item" href="#" id = "pdf_button">as PDF</a>
  </div>
</div>
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
</table>

<!-- Modal for deleting business role -->
<!-- https://stackoverflow.com/questions/32469873/show-bootstrap-modal-when-click-on-href-laravel - User: FewFlyBy - 09/09/15 -->
<div class="modal fade" id="training-liability-modal" tabindex="-1" role="dialog" aria-labelledby="training-liability-modal">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
<h4 class="modal-title" id="myModalLabel1">Email training liability data:</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <form method = "POST" action = "/trainingliability/email">
      {{ csrf_field() }}

      <div class="modal-body">
        <div class="form-group">
          <label for="emailAddress">Please enter the appropriate email address:</label>
          <input type="email" class="form-control" id="emailAddress" name = "emailAddress" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">Please only enter one email address...</small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Email Accounts</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div>
@endsection

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      // Add tooltips for column headings
      $('#immediate').tooltip();
      $('#approaching').tooltip();
      $('#distant').tooltip();

      // Download excel document of table data when button is clicked
      $('#excel_button').on('click', function() {
        // https://stackoverflow.com/questions/15547198/export-html-table-to-csv - Melancia - 21/3/13
        var csv = $('#expense_table').table2CSV({
          delivery: 'value'
        });

        window.location.href = 'data:text/csv;charset=UTF-8,' + encodeURIComponent(csv);

      });

      // Download word document of table data when button is clicked
      $('#word_button').on('click', function() {
        // https://stackoverflow.com/questions/36330859/export-html-table-as-word-file-and-change-file-orientation
        var htmltable= document.getElementById('expense_table');
        var html = htmltable.outerHTML;
        window.open('data:application/msword,' + '\uFEFF' + encodeURIComponent(html));
      });

      // Download pdf document of table data when button is clicked
      $('#pdf_button').on('click', function() {
        demoFromHTML();
      });

      /*$('#email_button').on('click', function() {
        emailUsers();
      });*/

    });
  </script>

  <script>
    // https://stackoverflow.com/questions/26100014/html-table-to-pdf-using-javascript
    function demoFromHTML() {
      // Use jsPDF to generate pdf of table data
      var pdf = new jsPDF('p', 'pt', 'letter');

      pdf.cellInitialize();
      pdf.setFontSize(10);
      $.each( $('#expense_table tr'), function (i, row){
          $.each( $(row).find("td, th"), function(j, cell){
              var txt = $(cell).text().trim() || " ";
              var width = (j==0) ? 250 : 70; //make 1st column smaller
              pdf.cell(10, 50, width, 30, txt, i);
          });
      });

      pdf.save('download.pdf');
    }
  </script>

  <script>
    /*function emailUsers() {
      var subject = "Net Training Liability - {{ $today }}";
      var body = $('#expense_table').html();

      window.location.href('mailto:test@example.com?subject=' + subject + '&body=' + body);
    }*/
  </script>
@endsection
