@extends('layouts.master')

@section('content')
<button class = "btn btn-primary" style = "float: right; margin-left: 20px;" type = "button" id = "email_button">Email Accounts</button>
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
    @foreach($business_roles as $business_role)
      <tr>
        <td><strong>{{ $business_role->name }}</strong></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      @foreach($courses[$business_role->id] as $course)
        @foreach($green_enrolments["$business_role->id-$course->course_id"] as $green_enrolment)
          @foreach($yellow_enrolments["$business_role->id-$course->course_id"] as $yellow_enrolment)
            @foreach($red_enrolments["$business_role->id-$course->course_id"] as $red_enrolment)
              @foreach($pending_enrolments["$business_role->id-$course->course_id"] as $pending_enrolment)
                @foreach($completed_enrolments["$business_role->id-$course->course_id"] as $completed_enrolment)
                  @foreach($users[$business_role->id] as $user)
                    <tr>
                      <td style = "padding-left: 30px;">{{ $course->name }}</td>
                      <!--  Why is it not passing into ALL business role courses? Seems to be totalling in one per role? -->
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
      <td><strong>Total Expense:</strong></td>
      <td><strong>${{ $immediate_total }}</strong></td>
      <td><strong>${{ $approaching_total }}</strong></td>
      <td><strong>${{ $distant_total }}</strong></td>
    </tr>
  </tbody>
</table>
@endsection

@section('footer-scripts')
  <script>
    $(document).ready(function() {
      $('#immediate').tooltip();
      $('#approaching').tooltip();
      $('#distant').tooltip();

      $('#excel_button').on('click', function() {
        // https://stackoverflow.com/questions/15547198/export-html-table-to-csv - Melancia - 21/3/13
        var csv = $('#expense_table').table2CSV({
          delivery: 'value'
        });

        window.location.href = 'data:text/csv;charset=UTF-8,' + encodeURIComponent(csv);

      });

      $('#word_button').on('click', function() {
        // https://stackoverflow.com/questions/36330859/export-html-table-as-word-file-and-change-file-orientation
        var htmltable= document.getElementById('expense_table');
        var html = htmltable.outerHTML;
        window.open('data:application/msword,' + '\uFEFF' + encodeURIComponent(html));
      });

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
