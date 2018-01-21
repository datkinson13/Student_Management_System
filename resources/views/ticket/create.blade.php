@extends('layouts.master')

@section('content')
<h1>Submit a ticket</h1>
<!-- Create ticket form -->
<form method = "POST" action = "/tickets">
  {{ csrf_field() }}

  <div class="form-group">
    <label for="subject">Subject:</label>
    <input type="text" class="form-control" id="subject" name="subject" aria-describedby="subject" placeholder="Subject...">
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <textarea class="form-control" id="description" name="description" rows="6" placeholder = "The issue is..."></textarea>
  </div>
  <div class = "row">
    <div class="form-group col-md-6">
      <label for="priority">Ticket priority:</label>
      <select class="form-control" id="priority" name = "priority">
        <option selected = "selected" value = "Low">Low</option>
        <option value = "Normal">Normal</option>
        <option value = "High">High</option>
        <option value = "Urgent">Urgent</option>
      </select>
    </div>

    @if(Auth::User()->inRole('administrator'))
      <div class="form-group col-md-6">
        <label for="status">Ticket Status:</label>
        <select class="form-control" id="status" name = "status" value = "Open">
          <option selected = "selected" value = "Open">Open</option>
          <option value = "Pending">Pending</option>
          <option value = "Solved">Solved</option>
          <option value = "Closed">Closed</option>
        </select>
      </div>
    @else
      <div class="form-group col-md-6">
        <label for="status">Ticket Status:</label>
        <select class="form-control" id="status" name = "status" readonly value = "Open">
          <option selected = "selected" value = "Open">Open</option>
          <option value = "Pending">Pending</option>
          <option value = "Solved">Solved</option>
          <option value = "Closed">Closed</option>
        </select>
      </div>
    @endif
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
