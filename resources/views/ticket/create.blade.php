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
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
