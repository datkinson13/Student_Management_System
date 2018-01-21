@extends('layouts.master')

@section('content')
<a href = "/tickets/create"><button class = "btn btn-primary user-profile-buttons">Submit a ticket</button></a>
<h1>My Tickets</h1>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Subject</th>
        <th>Lasted Updated</th>
        <th>Priority</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <!-- Display all tickets created -->
      @foreach($tickets as $ticket)
        <tr>
          <td>{{ $ticket->id }}</td>
          <td>{{ $ticket->user->Fname }} {{ $ticket->user->Lname }}</td>
          <td>{{ $ticket->subject }}</td>
          <td>{{ $ticket->updated_at }}</td>
          <td>{{ $ticket->priority }}</td>
          <td>{{ $ticket->status }}</td>
          <td>
            <td>
              <a href = "/tickets/{{ $ticket->id }}"><button class = "btn btn-primary user-action-buttons">View Ticket</button></a>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
