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
      <select class="form-control" id="priority">
        <option>Low</option>
        <option>Normal</option>
        <option>High</option>
        <option>Urgent</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="status">Ticket Status:</label>
      <select class="form-control" id="status">
        <option>Open</option>
        <option>Pending</option>
        <option>Solved</option>
        <option>Closed</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
