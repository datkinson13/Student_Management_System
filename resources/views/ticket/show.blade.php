@extends('layouts.master')

@section('content')
<!-- Display ticket details -->

<h1>Ticket: #{{ $ticket->id }}</h1>
<div class = "row">
  <h5 class = "col-md-3">Ticket ID: </h5>
  <p>#{{ $ticket->id }}</p>
</div>
<div class = "row">
  <h5 class = "col-md-3">Ticket created: </h5>
  <p>{{ $ticket->created_at }}</p>
</div>
<div class = "row">
  <h5 class = "col-md-3">Ticket last updated: </h5>
  <p>{{ $ticket->updated_at }}</p>
</div>
<div class = "row">
  <h5 class = "col-md-3">Ticket Priority: </h5>
  <p>{{ $ticket->priority }}</p>
</div>
<div class = "row">
  <h5 class = "col-md-3">Ticket Status: </h5>
  <p>{{ $ticket->status }}</p>
</div><br/>
<h5>Subject: </h5>
<p>{{ $ticket->subject }}</p>
<h5>Description: </h5>
<p>{{ $ticket->description }}</p><br/>
<hr/>
<br/>

<div class = "comments">
  <ul class = "list-group">
    <!-- Display all ticket comments -->
    @foreach($ticket->comments as $comment)
      <li class = "list-group-item" style = "margin-bottom: 5px;">

        @if($comment->user->inRole('administrator'))
          <div style = "padding-left: 100px;">
            <i class="fa fa-rebel" aria-hidden="true"></i> <strong>{{ $comment->user->Fname }} {{ $comment->user->Lname }}</strong><br/>
            <em>{{ $comment->created_at->diffForHumans() }}</em><br/><br/>
            {{ $comment->body }}
          </div>
        @else
          {{ $comment->user->Fname }} {{ $comment->user->Lname }}<br/>
          <em>{{ $comment->created_at->diffForHumans() }}</em><br/><br/>
          {{ $comment->body }}
        @endif
      </li>
    @endforeach
  </ul>
</div>

<div class = "card" style = "margin-top: 20px;">
  <div class = "card-block">
    <!-- Display add comment textbox -->
    <form method = "POST" action="/tickets/{{ $ticket->id }}/comments">
      {{ csrf_field() }}

      <div class = "form-group">
        <textarea style = "margin: 20px; width: 640px;" name = "body" id = "body" placeholder = "Enter comment..." class = "form-control"></textarea>
      </div>
      <div class = "form-group">
        <button style = "margin-left: 20px;" class="btn btn-primary" type="submit">Add comment</button>
      </div>
    </form>
  </div>
</div>
@endsection
